<div class="card-body">
    <form action="{{ url()->current() }}" method="get">
        <div class="row align-items-end">
            <!-- Sort By -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sort_by" class="form-label">Sort By</label>
                    <select name="sort_by" id="sort_by" class="form-control">
                        <option selected disabled value="">Select</option>
                        <option value="id">ID</option>
                        <option value="name">Name</option>
                        <option value="created_at">Created At</option>
                    </select>
                </div>
            </div>

            <!-- Order By -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="order_by" class="form-label">Order By</label>
                    <select name="order_by" id="order_by" class="form-control">
                        <option selected disabled value="">Select</option>
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </div>
            </div>

            <!-- Limit -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="limit_by" class="form-label">Limit</label>
                    <select name="limit_by" id="limit_by" class="form-control">
                        <option selected disabled value="">Select</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="40">40</option>
                    </select>
                </div>
            </div>

            <!-- Status -->
            <div class="col-md-2">
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status"  class="form-control">
                        <option selected disabled value="">Status </option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Keyword -->
            <div class="col-md-3">
                <div class="form-group">
                    <label for="keyword" class="form-label">Search</label>
                    <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Enter keyword...">
                </div>
            </div>

            <!-- Search Button -->
            <div class="col-md-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-info w-100">
                        <i class="fa fa-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
