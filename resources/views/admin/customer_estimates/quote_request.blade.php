@extends('layouts.master')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="col-md-12">
        <ul class="nav nav-tabs" id="orderTabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="new-orders-tab" data-toggle="tab" href="#new-orders" role="tab">New Orders</a>
          </li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#approved-orders">Approved Orders</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dept1">Department 1</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dept2">Department 2</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#dept3">Department 3</a></li>
        </ul>

        <div class="tab-content" id="orderTabsContent">
          <!-- New Orders Tab -->
          <div class="tab-pane fade show active" id="new-orders" role="tabpanel">
            <div class="card mt-2">
              <div class="card-header">
                <h4 class="card-title">Quote Requests - New Orders</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date & Time</th>
                        <th>Quote Number</th>
                        <th>Product</th>
                        <th>Customer Info</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>2025-07-10 14:30</td>
                        <td>#345446</td>
                        <td>Books > Comic Books</td>
                        <td>John Doe<br>john@example.com<br>+91-99999-99999</td>
                        <td>123 Main Street, Springfield</td>
                        <td>
                          <a href="{{ route('admin.quote.index') }}" class="btn btn-sm btn-info mb-1">View Quote Detail</a>
                          <a href="{{ route('admin.customers.detail') }}" class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
                          <button class="btn btn-sm btn-warning mb-1" data-toggle="modal" data-target="#changeStatusModal">Change Status</button>
                          <button class="btn btn-sm btn-secondary mb-1" data-toggle="modal" data-target="#viewNotesModal">View All Notes</button>
                          <a href="{{ route('admin.quote.index') }}" class="btn btn-sm btn-dark mb-1">View Invoice</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Other Tabs (blank) -->
          <div class="tab-pane fade" id="approved-orders"><div class="card mt-2"><div class="card-body text-muted">No approved orders.</div></div></div>
          <div class="tab-pane fade" id="dept1"><div class="card mt-2"><div class="card-body text-muted">No orders in Department 1.</div></div></div>
          <div class="tab-pane fade" id="dept2"><div class="card mt-2"><div class="card-body text-muted">No orders in Department 2.</div></div></div>
          <div class="tab-pane fade" id="dept3"><div class="card mt-2"><div class="card-body text-muted">No orders in Department 3.</div></div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Change Status Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form>
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Change Order Status</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <label>Status</label>
          <select class="form-control" id="statusSelect">
            <option value="">Select</option>
            <option value="approved">Approved</option>
            <option value="cancelled">Cancelled</option>
            <option value="department">Process to Department</option>
          </select>

          <div id="departmentFields" class="mt-3" style="display:none;">
            <label>Department Name</label>
            <input type="text" class="form-control" placeholder="Enter Department Name">
            <label class="mt-2">Notes</label>
            <textarea class="form-control" rows="3" placeholder="Enter notes here..."></textarea>
          </div>
        </div>
        <div class="modal-footer"><button type="submit" class="btn btn-primary">Save</button></div>
      </div>
    </form>
  </div>
</div>

<!-- View All Notes Modal -->
<div class="modal fade" id="viewNotesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">All Notes (Department-wise)</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>
      <div class="modal-body">
        <div class="row">
          <!-- Note Card 1 -->
          <div class="col-md-6">
            <div class="card border mb-3">
              <div class="card-body">
                <p><strong>Date & Time:</strong> 2025-07-10 15:00</p>
                <p><strong>Department:</strong> Department 1</p>
                <p><strong>Notes:</strong> Order processed and sent to print department.</p>
              </div>
            </div>
          </div>

          <!-- Note Card 2 -->
          <div class="col-md-6">
            <div class="card border mb-3">
              <div class="card-body">
                <p><strong>Date & Time:</strong> 2025-07-09 12:30</p>
                <p><strong>Department:</strong> Department 2</p>
                <p><strong>Notes:</strong> Graphics updated and verified.</p>
              </div>
            </div>
          </div>

          <!-- Add more cards as needed -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#statusSelect').on('change', function () {
    $('#departmentFields').toggle($(this).val() === 'department');
  });
</script>
@endsection
