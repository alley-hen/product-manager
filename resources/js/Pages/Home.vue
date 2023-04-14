<template>
    <article class="bg-gray-800 h-screen w-100 text-center flex flex-col items-center justify-center">
        <img src="../../../public/img/LogoImg.png" class="h-20 rounded-sm" alt="">
        <div class="mt-8">
            <Link :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500" >
                Log in
            </Link>
            <Link :href="route('register')"
                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register
            </Link>
        </div>
    </article>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    components: {
        Link,
    },
}
</script>

