<template>
    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Medicine Image and Basic Info -->
            <div class="col-lg-5 col-md-6 mb-4">
                <div class="medicine-image-section">
                    <img 
                        v-if="medicine.image_url" 
                        :src="medicine.image_url"
                        :alt="medicine.name"
                        class="img-fluid w-100 border rounded"
                        style="max-height: 500px; object-fit: contain;"
                        @error="handleImageError($event)"
                    />
                    <div v-else class="border rounded d-flex align-items-center justify-content-center" style="height: 400px; background: #f5f5f5;">
                        <i class="fas fa-pills fa-5x text-muted"></i>
                    </div>
                </div>
            </div>

            <!-- Medicine Details -->
            <div class="col-lg-7 col-md-6">
                <div class="medicine-info-section">
                    <h1 class="mb-3">{{ medicine.name }}</h1>
                    
                    <div v-if="medicine.generic_name" class="mb-2">
                        <strong>Generic Name:</strong> {{ medicine.generic_name }}
                    </div>
                    
                    <div v-if="medicine.manufacturer" class="mb-2">
                        <strong>Manufacturer:</strong> {{ medicine.manufacturer }}
                    </div>

                    <div v-if="medicine.category" class="mb-3">
                        <span class="badge badge-primary mr-2">{{ medicine.category.name }}</span>
                        <span v-if="medicine.subcategory" class="badge badge-secondary">{{ medicine.subcategory.name }}</span>
                    </div>

                    <div v-if="medicine.rating" class="mb-3">
                        <strong>Rating:</strong>
                        <span v-for="i in 5" :key="i" class="text-warning">
                            <i :class="i <= Math.round(medicine.rating) ? 'fas fa-star' : 'far fa-star'"></i>
                        </span>
                        <span class="ml-2">({{ medicine.rating }})</span>
                    </div>

                    <div class="price-section mb-4">
                        <div v-if="medicine.sale_price" class="mb-2">
                            <span class="h3 text-primary font-weight-bold">Rs. {{ formatPrice(medicine.sale_price) }}</span>
                            <span v-if="medicine.price && medicine.price > medicine.sale_price" class="ml-2 text-muted text-decoration-line-through">Rs. {{ formatPrice(medicine.price) }}</span>
                        </div>
                        <div v-else-if="medicine.price">
                            <span class="h3 text-primary font-weight-bold">Rs. {{ formatPrice(medicine.price) }}</span>
                        </div>
                    </div>

                    <div v-if="medicine.pack_size" class="mb-3">
                        <strong>Pack Size:</strong> {{ medicine.pack_size }}
                    </div>

                    <div v-if="medicine.pack_price || medicine.pack_sale_price" class="mb-3">
                        <strong>Pack Price:</strong>
                        <span v-if="medicine.pack_sale_price" class="text-primary font-weight-bold">Rs. {{ formatPrice(medicine.pack_sale_price) }}</span>
                        <span v-else-if="medicine.pack_price" class="text-primary font-weight-bold">Rs. {{ formatPrice(medicine.pack_price) }}</span>
                    </div>

                    <div class="action-buttons mt-4">
                        <button class="btn btn-primary btn-lg mr-2">
                            <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                        </button>
                        <button class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-heart mr-2"></i>Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medicine Details Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="medicineTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="ingredients-tab" data-toggle="tab" href="#ingredients" role="tab">Ingredients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="uses-tab" data-toggle="tab" href="#uses" role="tab">Uses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="side-effects-tab" data-toggle="tab" href="#side-effects" role="tab">Side Effects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="precautions-tab" data-toggle="tab" href="#precautions" role="tab">Precautions</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="medicineTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div v-if="medicine.details && medicine.details.description" v-html="medicine.details.description"></div>
                        <p v-else class="text-muted">No description available.</p>
                    </div>
                    <div class="tab-pane fade" id="ingredients" role="tabpanel">
                        <div v-if="medicine.details && medicine.details.ingredients" v-html="medicine.details.ingredients"></div>
                        <p v-else class="text-muted">No ingredients information available.</p>
                    </div>
                    <div class="tab-pane fade" id="uses" role="tabpanel">
                        <div v-if="medicine.details && medicine.details.uses" v-html="medicine.details.uses"></div>
                        <p v-else class="text-muted">No uses information available.</p>
                    </div>
                    <div class="tab-pane fade" id="side-effects" role="tabpanel">
                        <div v-if="medicine.details && medicine.details.side_effects" v-html="medicine.details.side_effects"></div>
                        <p v-else class="text-muted">No side effects information available.</p>
                    </div>
                    <div class="tab-pane fade" id="precautions" role="tabpanel">
                        <div v-if="medicine.details && medicine.details.precautions_and_warnings" v-html="medicine.details.precautions_and_warnings"></div>
                        <p v-else class="text-muted">No precautions information available.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Medicines -->
        <div v-if="relatedMedicines && relatedMedicines.length > 0" class="row mt-5">
            <div class="col-12">
                <h3 class="mb-4">Related Medicines</h3>
                <div class="row">
                    <div v-for="relatedMedicine in relatedMedicines" :key="relatedMedicine.id" class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <a :href="relatedMedicine.slug ? '/pharmacy/medicine/' + relatedMedicine.slug : '#'">
                                <img 
                                    v-if="relatedMedicine.image_url" 
                                    :src="relatedMedicine.image_url"
                                    :alt="relatedMedicine.name"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: contain; padding: 10px;"
                                    @error="handleImageError($event)"
                                />
                                <div v-else class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: #f5f5f5;">
                                    <i class="fas fa-pills fa-3x text-muted"></i>
                                </div>
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a :href="relatedMedicine.slug ? '/pharmacy/medicine/' + relatedMedicine.slug : '#'">{{ relatedMedicine.name }}</a>
                                </h5>
                                <div v-if="relatedMedicine.sale_price" class="mb-2">
                                    <span class="text-primary font-weight-bold">Rs. {{ formatPrice(relatedMedicine.sale_price) }}</span>
                                    <span v-if="relatedMedicine.price && relatedMedicine.price > relatedMedicine.sale_price" class="ml-2 text-muted small text-decoration-line-through">Rs. {{ formatPrice(relatedMedicine.price) }}</span>
                                </div>
                                <div v-else-if="relatedMedicine.price">
                                    <span class="text-primary font-weight-bold">Rs. {{ formatPrice(relatedMedicine.price) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PharmacyMedicineDetailSection',
    props: {
        fileSystemDriver: {
            type: String,
            default: 'local'
        },
        medicine: {
            type: Object,
            required: true
        },
        relatedMedicines: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        formatPrice(price) {
            if (!price) return '0.00';
            return parseFloat(price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        handleImageError(event) {
            // Hide broken image and show fallback icon
            if (event && event.target) {
                event.target.style.display = 'none';
                // Create fallback if it doesn't exist
                const parent = event.target.parentElement;
                if (parent) {
                    let fallback = parent.querySelector('.image-fallback');
                    if (!fallback) {
                        fallback = document.createElement('div');
                        fallback.className = 'border rounded d-flex align-items-center justify-content-center image-fallback';
                        fallback.style.cssText = 'height: 400px; background: #f5f5f5;';
                        fallback.innerHTML = '<i class="fas fa-pills fa-5x text-muted"></i>';
                        parent.appendChild(fallback);
                    } else {
                        fallback.style.display = 'flex';
                    }
                }
            }
        }
    }
}
</script>

<style scoped>
.medicine-image-section img {
    border: 1px solid #ddd;
    border-radius: 8px;
}

.price-section {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.action-buttons .btn {
    min-width: 150px;
}

.nav-tabs .nav-link {
    color: #495057;
    border: none;
    border-bottom: 2px solid transparent;
}

.nav-tabs .nav-link.active {
    color: #007bff;
    border-bottom-color: #007bff;
    background: transparent;
}

.tab-content {
    min-height: 200px;
    padding: 20px;
    border: 1px solid #dee2e6;
    border-top: none;
    border-radius: 0 0 8px 8px;
}

.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}
</style>

