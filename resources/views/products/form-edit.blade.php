<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProductModalLabel">Edit Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="edit_name" class="col-sm-3 col-form-label">Product Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_price" name="price" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_stock" class="col-sm-3 col-form-label">Stock</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_stock" name="stock" min="0" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="edit_image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                            <div id="edit_image_preview_wrapper" class="mt-2 d-none">
                                <img id="edit_image_preview" src="" alt="Preview produk" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>