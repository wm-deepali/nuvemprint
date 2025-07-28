<?php

namespace App\Http\Controllers;


use App\Models\Attribute;
use App\Models\DeliveryCharge;
use App\Models\PostalCode;
use App\Models\Subcategory;
use App\Models\Vat;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function showCart()
    {
        $item = session('cart.items', null);

        if (!$item) {
            return view('front.shop-cart', ['cartData' => null]);
        }

        $subcategory = Subcategory::find($item['subcategory_id']);
        $attributes = [];

        // To extract specific attributes
        $paperWeight = null;
        $paperSize = null;

        foreach ($item['attributes'] as $attrId => $valId) {
            $attribute = Attribute::find($attrId);
            $value = AttributeValue::find($valId);

            if ($attribute && $value) {
                $attributes[] = [
                    'attribute_name' => $attribute->name,
                    'value_name' => $value->value,
                ];

                $attrName = strtolower(trim($attribute->name));
                if ($attrName === 'paper weight') {
                    $paperWeight = $value->value; // e.g., "170gsm"
                } elseif ($attrName === 'paper size') {
                    $paperSize = $value->value; // e.g., "A5"
                }
            }
        }

        // Calculate total paper weight
        $totalWeight = null;

        if ($paperWeight && $paperSize && isset($item['pages']) && isset($item['quantity'])) {
            $gsm = (int) filter_var($paperWeight, FILTER_SANITIZE_NUMBER_INT);
            $pages = (int) $item['pages'];
            $quantity = (int) $item['quantity'];
            // Supported paper sizes (in mm)
            $sizeMap = [
                'A5' => [148, 210],
                'A4' => [210, 297],
                'A3' => [297, 420],
            ];

            if (isset($sizeMap[$paperSize])) {
                [$widthMm, $heightMm] = $sizeMap[$paperSize];
                $widthM = $widthMm * 0.001;
                $heightM = $heightMm * 0.001;
                $sheetArea = $widthM * $heightM;

                $sheetsPerCopy = ceil($pages / 2); // assuming double-sided
                $totalSheets = $sheetsPerCopy * $quantity;

                // dd($gsm , $sheetArea, $totalSheets);
                $totalWeightGrams = round($gsm * $sheetArea * $totalSheets, 2); // in grams
                $totalWeight = round($totalWeightGrams / 1000, 2); // in kg
            }
        }

        // Delivery
        $deliveryCharge = null;
        $deliveryTitle = 'Delivery';
        $deliveryPrice = 0;

        if (!empty($item['delivery']['id'])) {
            $deliveryCharge = DeliveryCharge::find($item['delivery']['id']);
            $deliveryPrice = $deliveryCharge->price ?? 0;
            $deliveryTitle = $deliveryCharge->title ?? 'Delivery';
        }

        $proofPrice = (float) ($item['proof']['price'] ?? 0);
        $totalPrice = (float) $item['total_price'];

        $vatPercentage = (float) Vat::where('country', $deliveryTitle)->value('vat_percentage') ?? 0;
        $subtotal = $totalPrice - $deliveryPrice - $proofPrice;
        $vatAmount = round(($totalPrice * $vatPercentage) / 100, 2);
        $grandTotal = $subtotal + $deliveryPrice + $proofPrice + $vatAmount;

        $cartData = [
            ...$item,
            'subcategory_name' => $subcategory->name ?? 'Unknown',
            'subcategory_thumbnail' => $subcategory->thumbnail ?? null,
            'attributes_resolved' => $attributes,
            'paper_total_weight' => $totalWeight,
            'subtotal' => $subtotal,
            'vat_percentage' => $vatPercentage,
            'vat_amount' => $vatAmount,
            'delivery_title' => $deliveryTitle,
            'grand_total' => $grandTotal,
        ];
        // dd($totalWeight);

        session(['cart.grand_total' => $grandTotal]);
        $allDeliveryCharges = DeliveryCharge::all();
        return view('front.shop-cart', compact('cartData', 'allDeliveryCharges'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'subcategory_id' => 'required|integer',
            'attributes' => 'required|array',
            'pages' => 'nullable|integer',
            'composite_pages' => 'nullable|array',
            'delivery.id' => 'nullable|integer',
            'delivery.date' => 'nullable|string',
            'delivery.price' => 'nullable|numeric',
            'proof.id' => 'nullable|integer',
            'proof.proof_type' => 'nullable|string',
            'proof.price' => 'nullable|numeric',
            'totalPrice' => 'required|numeric',
        ]);

        $cartItem = [
            'id' => uniqid(),
            'quote_id' => random_int(1000000, 9999999),
            'quantity' => $validated['quantity'],
            'attributes' => $validated['attributes'],
            'pages' => $validated['pages'] ?? null,
            'composite_pages' => $validated['composite_pages'] ?? [],
            'delivery' => $validated['delivery'] ?? [],
            'proof' => $validated['proof'] ?? [],
            'total_price' => $validated['totalPrice'],
            'subcategory_id' => $validated['subcategory_id'],
        ];

        session()->put('cart.items', $cartItem);

        // Detect AJAX or normal form
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart.',
                'redirect_url' => route('shop-cart'),
                'item' => $cartItem
            ]);
        }

        // Normal browser POST form, redirect
        return redirect()->route('shop-cart')->with([
            'success' => 'Product added to cart.',
            'last_item' => $cartItem
        ]);
    }

    public function getByTitle(Request $request)
    {
        $title = $request->input('title');

        $vatPercentage = Vat::where('country', $title)->value('vat_percentage');

        return response()->json([
            'vat_percentage' => $vatPercentage ?? 0
        ]);
    }


    public function check(Request $request)
    {
        $postcode = trim($request->input('postcode'));

        if (!$postcode) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please enter a postcode.'
            ], 422);
        }

        $postcodeEntry = PostalCode::where('pincode', $postcode)->first();

        if (!$postcodeEntry) {
            return response()->json([
                'status' => 'not_found',
                'message' => 'Sorry, we do not recognize this postcode.'
            ]);
        }

        if (!$postcodeEntry->is_serviceable) {
            return response()->json([
                'status' => 'not_serviceable',
                'message' => 'We found your postcode, but unfortunately we do not deliver to this area yet.',
                'postcode' => $postcodeEntry->pincode,
                'city' => $postcodeEntry->city,
                'state' => $postcodeEntry->state,
                'country' => $postcodeEntry->country,
            ]);
        }

        return response()->json([
            'status' => 'serviceable',
            'message' => 'Great news! We deliver to your area.',
            'postcode' => $postcodeEntry->pincode,
            'city' => $postcodeEntry->city,
            'state' => $postcodeEntry->state,
            'country' => $postcodeEntry->country,
            'delivery_charge' => $postcodeEntry->delivery_charge,
        ]);
    }

}
