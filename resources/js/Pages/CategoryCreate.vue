<template>
    <article class="bg-gray-100 w-100 h-min text-center">
        <Navbar/>

        <header class="w-1/2 m-auto">
            <div class=" flex justify-between mt-8">
                <LinkButton :href="route('categories')" class="mr-2">
                    <IconArrowLeft class="mr-2"/>
                    Categories
                </LinkButton>
            </div>
        </header>

        <section class="mt-8 w-1/2 m-auto pb-10">
            <form @submit.prevent="submit" class="p-6 rounded-md bg-white border border-gray-300 shadow-neutral-500">
                <h2 class="mb-6 text-3xl text-gray-600 justify-center items-center flex space-x-6 capitalize">
                    Create Category
                    <IconCompose class="ml-6 text-gray-500"/>
                </h2>
                <div class="grid grid-cols-1 gap-4 mb-4 text-left capitalize">
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
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta Title</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_title">
                            {{ errors.meta_title }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="form.meta_title"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta Description</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_description">
                            {{ errors.meta_description }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="form.meta_description"/>
                    </div>
                    <div class="flex flex-col">
                        <label class="text-sm mb-2 mb-1 pl-1 font-medium text-gray-700 uppercase">Meta Keywords</label>
                        <div class="text-red-500 text-xs mb-1 pl-1 normal-case" v-if="errors.meta_keywords">
                            {{ errors.meta_keywords }}
                        </div>
                        <input type="text" required
                               class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                               v-model="form.meta_keywords"/>
                    </div>
                </div>

                <PrimaryBasicButton @click="storeCategory" class="mt-4" :class="{ 'opacity-25': saving }" :disabled="saving">
                    <IconSaveDisk class="mr-2"/>
                    Save
                </PrimaryBasicButton>
            </form>
        </section>
    </article>
</template>

<script>
import Navbar from "@/Pages/ui/Navbar.vue";
import LinkButton from "@/Pages/ui/LinkButton.vue";
import PrimaryBasicButton from "@/Pages/ui/PrimaryBasicButton.vue";
import SecondaryBasicButton from "@/Pages/ui/SecondaryBasicButton.vue";
import {router} from "@inertiajs/vue3";
import {
    IconAddOutline,
    IconSaveDisk,
    IconArrowLeft,
    IconCompose
} from '@iconify-prerendered/vue-zondicons'

export default {
    name: "CategoryCreate",

    components: {
        Navbar,
        LinkButton,
        PrimaryBasicButton,
        SecondaryBasicButton,
        IconAddOutline,
        IconSaveDisk,
        IconArrowLeft,
        IconCompose
    },

    props: {
        errors: {
            type: Object
        }
    },
    data: () => ({
        form: {
            name: '',
            meta_title: '',
            meta_description: '',
            meta_keywords: '',
        },
        saving: false
    }),

    methods: {
        storeCategory() {
            this.saving = true
            router.post(`/categories/store`, this.form, {
                onFinish: () => { this.saving = false }
            })
        }
    },
}
</script>

