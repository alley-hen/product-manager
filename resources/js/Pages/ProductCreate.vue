<template>
    <article class="bg-gray-100 w-100 h-min text-center">
        <Navbar/>
        <header class="m-auto">
            <div class="flex justify-end mt-6 mr-6">
                <LinkButton :href="route('products')" class="mr-2">
                    <IconArrowLeft class="mr-2"/>
                    Products
                </LinkButton>
            </div>
        </header>

        <section class="mt-8 w-1/2 m-auto pb-10">
            <form @submit.prevent="submit" class="p-6 rounded-md bg-white border border-gray-300 shadow-neutral-500">
                <h2 class="mb-6 text-3xl text-gray-600 justify-center items-center flex space-x-6 uppercase">
                    Create New Product
                    <IconCompose class="ml-6 text-gray-500"/>
                </h2>
<!--                Product fields-->
                <div class="grid grid-cols-2 gap-4 mb-4 text-left capitalize">
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Name</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.name">
                            {{ errors.name }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="form.name"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Slug</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.name">
                            {{ errors.slug }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="form.slug"/>
                    </div>
                </div>
<!--                Save-->
                <div class="m-auto mt-8">
                    <PrimaryBasicButton @click="storeProduct" class="" :class="{ 'opacity-25': saving }" :disabled="saving">
                        <IconSaveDisk class="mr-2"/>
                        Save
                    </PrimaryBasicButton>
                </div>
            </form>
        </section>
        <div v-if="saving" class="text-3xl pb-10 h-screen">Saving...</div>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import PrimaryBasicButton from "@/Pages/ui/PrimaryBasicButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import {Link} from "@inertiajs/vue3";
import {router} from "@inertiajs/vue3";
import {
    IconSaveDisk,
    IconArrowLeft,
    IconCompose,
} from '@iconify-prerendered/vue-zondicons'

export default {
    name: "productCreate",

    components: {
        Navbar,
        Link,
        LinkButton,
        PrimaryBasicButton,
        SecondaryBasicButton,
        IconSaveDisk,
        IconArrowLeft,
        IconCompose,
    },

    props: {
        errors: {
            type: Object
        }
    },
    data: () => ({
        saving: false,
        form: {
            name: '',
            slug: '',
        },
    }),

    methods: {
        storeProduct() {
            this.saving = true
            router.post(`/products/store`, this.form, {
                onFinish: () => { this.saving = false }
            })
        },
    }
}
</script>

