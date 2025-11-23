 <!-- Thêm tour -->
        <div class="card mb-4">
          <div class="card-body">
            <form method="post" action="<?php echo BASE_URL; ?>?mode=admin&action=addtour">
              <div class="row g-2">
                <div class="col-md-3">
                  <input type="text" name="tour_name" class="form-control" placeholder="Tên tour" required>
                </div>
                <div class="col-md-2">
                  <input type="number" name="category_id" class="form-control" placeholder="Mã loại" required>
                </div>
                <div class="col-md-5">
                  <input type="text" name="description" class="form-control" placeholder="Mô tả">
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn btn-success w-100">Thêm tour</button>
                </div>
              </div>
            </form>
          </div>
        </div>