<template>
    <article class="bg-gray-100 h-min w-100 text-center">
        <Navbar/>

        <header class="px-16">
            <div class="flex justify-end mt-3 mr-3">
                <secondary-basic-button :href="'/products/create'">
                    <IconAddOutline class="mr-2"/>
                    New Product
                </secondary-basic-button>
            </div>
            <h1 class="px-3 py-3 text-4xl capitalize font-semibold">Products <span class="text-sm">({{ filteredProducts.length }})</span></h1>
        </header>

        <section class="my-6 px-16">
            <div>
                <label class="mr-2" for="category-select">Filter by category:</label>
                <select class="rounded" id="category-select" v-model="selectedCategoryId">
                    <option value="">All categories</option>
                    <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
            </div>
            <table class="table-auto min-w-full text-left mt-4 text-sm">
                <thead class="border-y font-semibold dark:border-neutral-500 bg-primary-dark text-white">
                <tr>
                    <td class="px-6 py-4">Name</td>
                    <td class="px-6 py-4">Categories</td>
                    <td class="px-6 py-4">Variants</td>
                    <td class="px-6 py-4"></td>
                </tr>
                </thead>
                <tbody class="font-medium">
                    <tr class="border-b dark:border-neutral-500" v-for="product in filteredProducts" :key="product.id">
                        <td class="px-6 py-4 font-medium capitalize">
                             {{ product.name }}
                        </td>
                        <td class="px-6 py-4 font-medium">
                            <div class="text-gray-500 capitalize" v-for="category in product.categories" :key="category.id" >
                                {{ category.name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ product.variants.length }}
                        </td>
                        <td class="py-4 font-medium">
                            <LinkButton class="w-16" :href="route('products.edit', product)">
                                EDIT
                            </LinkButton>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import {Link} from "@inertiajs/vue3";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {
    IconAddOutline
} from '@iconify-prerendered/vue-zondicons'
import {router} from "@inertiajs/vue3";

export default {
    name: "Products",

    components: {
        Navbar,
        Link,
        LinkButton,
        SecondaryBasicButton,
        IconAddOutline,
    },

    props: {
        products: {
            type: Array,
        },
        categories: Array
    },

    data: () => ({
        selectedCategoryId: ''
    }),

    computed: {
      filteredProducts(){
          if(this.selectedCategoryId > 0){
              return this.products.filter((product) => {
                  const match =  product.categories.map(category => category.id === this.selectedCategoryId)
                  if(match.includes(true)){
                      return product
                  }
              })
          } else {
              return this.products
          }
      },
    }
}
</script>

