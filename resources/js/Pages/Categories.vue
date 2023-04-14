<template>
    <article class="bg-gray-100 h-min w-100 text-center">
        <Navbar/>

        <header class="m-auto">
            <div class="flex justify-end mt-8 mr-8">
                <secondary-basic-button :href="route('categories.create')">
                    <IconAddOutline class="mr-2"/>
                    New Category
                </secondary-basic-button>
            </div>
            <h1 class="mt-3 text-4xl">CATEGORIES <span class="text-sm">({{ categories.length }})</span></h1>
        </header>

        <section class="mt-10 mx-24">
            <div class="grid grid-cols-4 gap-6">
                <div
                    class="h-32 m-1 p-4 pb-1 text-xl bg-white text-gray-800 rounded-lg border text-left flex flex-col justify-between"
                    v-for="category in categories" :key="category.id">
                    <div class="capitalize">
                        {{ category.name }}
                        <div class="rounded-sm p-1 mt-2 w-20 text-center bg-cyan-800 text-white text-xs">
                            {{ category.products_count }} Products
                        </div>
                    </div>
                    <div class="flex items-center m-1 justify-end">
                        <Link class="capitalize text-xs hover:text-black text-gray-400"
                              :href="route('categories.show', category)">
                            <span>View Category</span>
                            <IconArrowRight class="ml-1 inline"/>
                        </Link>
                    </div>
                </div>
            </div>
        </section>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import {Link} from "@inertiajs/vue3";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {IconAddOutline, IconArrowRight} from "@iconify-prerendered/vue-zondicons";

export default {
    name: "Categories",

    components: {
        Navbar,
        Link,
        LinkButton,
        SecondaryBasicButton,
        IconAddOutline,
        IconArrowRight
    },

    props: {
        categories: {
            type: Object,
        }
    },
}
</script>

