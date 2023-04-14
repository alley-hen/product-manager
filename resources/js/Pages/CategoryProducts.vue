<template>
    <article class="bg-gray-100 h-min w-100 text-center">
        <Navbar/>

        <header class="px-24">
            <div class="flex justify-between mt-6">
                <LinkButton :href="route('categories')" class="mr-2">
                    <IconArrowLeft class="mr-2"/>
                    Categories
                </LinkButton>
                <secondary-basic-button :href="route('categories.edit', category)">
                    <IconEditPencil class="mr-2"/>
                    Edit Category
                </secondary-basic-button>
            </div>
            <h1 class="px-3 py-3 text-4xl capitalize font-semibold">Category: {{ category.name }}</h1>
        </header>

        <section class="my-6 px-24">
            <h2 class="m-0 text-white text-2xl capitalize bg-primary-dark">{{ category.name }} Products</h2>
            <table v-if="category.products.length > 0" class="table-auto min-w-full text-left text-md">
                <thead class="font-semibold dark:border-neutral-500 bg-primary-dark text-white">
                    <tr>
                        <td class="px-6 py-4">Name</td>
                        <td class="px-6 py-4">Slug</td>
                        <td class="px-6 py-4">Variants</td>
                    </tr>
                </thead>
                <tbody class="font-medium">
                    <tr class="border-b text-slate-800 dark:border-neutral-500" v-for="product in category.products" :key="product.id">
                        <td class="px-6 py-3 font-medium capitalize">{{ product.name }}</td>
                        <td class="px-6 py-3 font-medium capitalize">{{ product.slug }}</td>
                        <td class="px-6 py-3 font-medium">
                            <div class="capitalize text-gray-500" v-for="variant in product.variants" :key="variant.id">
                                {{ variant.name }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h3 class="h-screen py-4" v-else>This Category has no products associated with it.</h3>
        </section>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {
    IconArrowLeft,
    IconEditPencil
} from '@iconify-prerendered/vue-zondicons'

export default {
    name: "CategoryProducts",

    components: {
        Navbar,
        LinkButton,
        SecondaryBasicButton,
        IconArrowLeft,
        IconEditPencil,
    },

    props: {
        category: {
            type: Object,
        }
    },
}
</script>

