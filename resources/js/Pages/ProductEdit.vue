<template>
    <article class="bg-gray-100 w-100 h-min text-center">
        <Navbar/>

        <header class="w-1/2 m-auto">
            <div class=" flex justify-between mt-8">
                <LinkButton :href="route('products')" class="mr-2">
                    <IconArrowLeft class="mr-2"/>
                    Back
                </LinkButton>
                <secondary-basic-button :href="route('products.create')">
                    <IconAddOutline class="mr-2"/>
                    New product
                </secondary-basic-button>
            </div>
        </header>

        <section class="mt-8 w-1/2 m-auto pb-10" v-if="!saving && !deleting">
            <form @submit.prevent="submit" class="p-6 rounded-md bg-white border border-gray-300 shadow-neutral-500">
<!--                Product fields-->
                <h2 class="mb-6 text-3xl text-gray-600 justify-center items-center flex space-x-6 uppercase">
                    Edit product
                    <IconCompose class="ml-6 text-gray-500"/>
                </h2>
                <div class="grid grid-cols-2 gap-4 mb-4 text-left capitalize">
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 pl-1 font-medium text-gray-700 uppercase">Name</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.name">
                            {{ errors.name }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="product.name"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 pl-1 font-medium text-gray-700 uppercase">Slug</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.slug">
                            {{ errors.slug }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="product.slug"/>
                    </div>
<!--                    product categories-->
                    <div class="flex flex-col col-span-2 mt-4">
                        <hr>
                        <p class="text-md my-4 pl-1 font-medium text-gray-700 uppercase">Product Categories</p>
                        <ul v-if="hasCategories">
                            <li v-for="category in product.categories"
                                :key="category.id"
                                class="text-sm py-1 px-2 border m-1 font-medium rounded-md flex justify-between items-center">
                                <span>{{ category.name }}</span>
                                <IconCloseSolid @click="removeCategory(category.id)" class="ml-4 inline text-gray-500 hover:text-red-500"/>
                            </li>
                        </ul>
                        <p class="text-sm text-gray-500" v-else>Product not assigned to any categories</p>

                        <div v-if="!showAddCategory"
                             @click="showAddCategory = !showAddCategory"
                             class="mt-4 mx-1 flex justify-center items-center rounded-md bg-secondary text-white font-semibold p-1 text-center hover:bg-secondary-light hover:cursor-pointer uppercase">
                            <IconAddOutline class="mr-2 inline"/>
                            Add Product Category
                        </div>

                        <div v-if="showAddCategory" class="my-4 flex items-center">
                            <label class="mx-2 w-1/3" for="category-select">Select Category:</label>
                            <select class="rounded h-8 w-full" id="category-select" v-model="selectedCategory">
                                <option class="capitalize" v-for="category in availableCategories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                    </div>
<!--                    product variants-->
                    <div class="flex flex-col col-span-2 mt-4">
                        <hr>
                        <p class="text-md my-4 mb-1 pl-1 font-medium text-gray-700 uppercase">Product Variants</p>
                        <ul v-if="hasVariants">
                            <li v-for="variant in product.variants"
                                :key="variant.id"
                                class="text-sm py-1 px-2 border m-1 font-medium rounded-md flex justify-between items-center">
                                <span>{{ variant.name }}</span>
                                <Link :href="route('variants.destroy', variant)" method="delete" as="button">
                                    <IconCloseSolid class="ml-4 inline text-gray-500 hover:text-red-500"/>
                                </Link>
                            </li>
                        </ul>
                        <p class="text-sm text-gray-500 ml-1" v-else>No Variants</p>

                        <Link :href="route('products.add-variant', product)"
                            class="mt-4 mx-1 flex justify-center items-center rounded-md bg-secondary text-white font-semibold p-1 text-center hover:bg-secondary-light uppercase">
                            <IconAddOutline class="mr-2 inline"/>
                            Add Product Variant
                        </Link>

                    </div>
                </div>
<!--                save / delete-->
                <div class="flex justify-center mt-8">
                    <PrimaryBasicButton @click="updateProduct" class="" :class="{ 'opacity-25': deleting || saving }" :disabled="saving || deleting">
                        <IconSaveDisk class="mr-2"/>
                        Save Product
                    </PrimaryBasicButton>
                    <button @click="deleteProduct"
                        :disabled="deleting"
                        class="font-semibold text-white px-4 py-2 rounded-md hover:shadow-neutral-400 flex justify-center items-center ml-6 bg-red-600 hover:bg-red-500 text-white uppercase"
                        :class="{ 'opacity-25': deleting || saving }">
                        <IconTrash class="mr-2"/>
                        Delete Product
                    </button>
                </div>
            </form>
        </section>

        <div v-if="saving" class="text-3xl pb-10 h-screen">Saving...</div>
        <div v-if="deleting" class="text-3xl pb-10 h-screen">Deleting...</div>

    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import {Link} from "@inertiajs/vue3";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import PrimaryBasicButton from "@/Pages/ui/PrimaryBasicButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {router} from "@inertiajs/vue3";
import {
    IconAddOutline,
    IconSaveDisk,
    IconArrowLeft,
    IconCompose,
    IconTrash,
    IconCloseSolid
} from '@iconify-prerendered/vue-zondicons'

export default {
    name: "productEdit",

    components: {
        Navbar,
        PrimaryBasicButton,
        SecondaryBasicButton,
        Link,
        LinkButton,
        IconAddOutline,
        IconSaveDisk,
        IconArrowLeft,
        IconCompose,
        IconTrash,
        IconCloseSolid,
    },

    props: {
        product: {
            type: Object,
        },
        categories: {
            type: Array
        },
        errors: {
            type: Object
        }
    },

    data: () => ({
        deleting: false,
        saving: false,
        showAddCategory: false,
        selectedCategory: 0,
    }),

    watch: {
        selectedCategory: function (value) {
            if (value > 0) {
                this.assignProductToCategory()
            }
        }
    },

    computed: {
        productCategoryIds() {
            return this.product.categories.map(category => category.id)
        },
        availableCategories() {
            return this.categories.filter(category => {
                const index = this.productCategoryIds.indexOf(category.id)
                if (index === -1) {
                    return category
                }
            })
        },
        hasCategories() {
            return this.product.categories?.length > 0
        },
        hasVariants() {
            return this.product.variants?.length > 0
        }
    },
    methods: {
        updateProduct() {
            this.saving = true
            router.patch(`/products/${this.product.id}/update`, this.product, {
                onFinish: () => {
                    this.saving = false
                }
            })
        },
        deleteProduct() {
            this.deleting = true
            router.delete(`/products/${this.product.id}`, {
                onFinish: () => {
                    this.deleting = false
                }
            })
        },
        assignProductToCategory() {
            this.saving = true
            router.post(`/products/${this.product.id}/add-to-category`, {category_id: this.selectedCategory}, {
                onFinish: () => {
                    return Promise.all([
                        this.selectedCategory = 0,
                        this.showAddCategory = false,
                        this.saving = false
                    ])
                }
            })
        },
        removeCategory(categoryId) {
            this.saving = true
            router.post(`/products/${this.product.id}/remove-from-category`, {category_id: categoryId}, {
                onFinish: () => {
                    this.saving = false
                }
            })
        },
    }
}
</script>

