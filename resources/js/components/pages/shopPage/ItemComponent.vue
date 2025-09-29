<template>
    <div class="item">
        <div class="image">
            
        </div>
        <h3>Название</h3>
        <div class="grid grid-cols-2">
            <span class="cost">1 000 очков</span>
            <button>Купить</button>
        </div>
    </div>
</template>

<script setup>

</script>

<style  scoped>
.item{
    border-radius: 12px;
    padding: 8px;
    width: 100%;
    background: var(--white-500);
}
.image{
    width: 100%;
    aspect-ratio: 2/1;
    background: #d9d9d9;
    border-radius: 8px;
    overflow: hidden;
}
h3{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-950);
}
.cost{
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--blue-500);
}
button{
    border-radius: 1000px;
    padding: 4px 8px;
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 13px;
    color: var(--white-500);
    background: var(--blue-500); 
    width: fit-content;
    margin-left: auto;
}
button:disabled{
    background: var(--white-400);
}
</style>