<template>
    <nav class="w-full bg-gray-800">
        <div class="pl-6 pr-2 flex justify-between items-center text-xl">
            <div class="mr-10 p-0 flex items-center text-xl py-3">
                <img src="../../../../public/img/LogoImg.png" class="h-12" alt="">
                <ul class="flex text-gray-200">
                    <li class="mx-16">
                        <Link class="py-6 px-3 hover:text-gray-800 hover:bg-gray-200 hover:font-semibold"
                              :href="route('categories')">Categories
                        </Link>
                    </li>
                    <li>
                        <Link class="py-6 px-3 hover:text-gray-800 hover:bg-gray-200 hover:font-semibold"
                              :href="route('products')">Products
                        </Link>
                    </li>
                </ul>
            </div>
            <ul>
                <li>
                    <Link :href="route('logout')" method="post" as="button"
                          class="text-gray-400 py-6 px-3 hover:text-gray-800 hover:bg-gray-200 hover:font-semibold">
                        <span>Log Out</span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Navbar",
    components: {
        Link
    },
};
</script>
