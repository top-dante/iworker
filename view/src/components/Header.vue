<template>
    <header class="wrapper-header">
        <a-breadcrumb>
            <a-breadcrumb-item><router-link to="/">工作台</router-link></a-breadcrumb-item>
            <template v-if="breadCrumb">
                <template v-for="item in breadCrumb" :key="item">
                    <a-breadcrumb-item>{{item}}</a-breadcrumb-item>
                </template>
            </template>
        </a-breadcrumb>
        <div class="wrapper-header-title">{{title}}</div>
    </header>
</template>

<script>
    export default {
        name: "Header",
        props:{
            title:{
                type:String,
                required:true
            },
            breadCrumb:Array,
            extra:String
        }
    }
</script>

<style scoped>

</style>