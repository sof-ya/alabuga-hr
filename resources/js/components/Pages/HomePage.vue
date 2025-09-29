<template>
    <LkLayout>
        <div class="">
            <div class="header">
                <div class="userPhoto">
                    <img 
                        :src="imgPhoto" 
                            alt="Аватар пользователя"
                            class=""
                        >
                </div>
                <div class="userInfo">
                    <h2 class="userName">{{ userData["name"] }}</h2>
                    <div class="userInfoItems">
                        <div class="userLevel">
                            1 Уровень
                        </div>
                        <div class="userRank">
                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#paint0_angular_2017_1428_clip_path)" data-figma-skip-parse="true">
                                    <g transform="matrix(0 0.00794384 -0.00794252 0 8.50062 7.99951)">
                                    <foreignObject x="-3685.97" y="-3685.97" width="7371.93" height="7371.93">
                                        <div xmlns="http://www.w3.org/1999/xhtml" style="background:conic-gradient(from 90deg,rgba(255, 255, 255, 1) 0deg,rgba(204, 181, 255, 1) 131.538deg,rgba(255, 255, 255, 1) 316.731deg,rgba(255, 255, 255, 1) 360deg);height:100%;width:100%;opacity:1"></div>
                                    </foreignObject>
                                    </g>
                                </g>
                                <path d="M15.0133 5.96551C14.9045 5.92661 14.8051 5.86531 14.7215 5.78557C14.6379 5.70583 14.572 5.60942 14.528 5.5026C14.484 5.39577 14.4629 5.28089 14.4661 5.1654C14.4694 5.04992 14.4968 4.93639 14.5466 4.83217C14.738 4.42954 14.8 3.97757 14.7242 3.53828C14.6484 3.09899 14.4385 2.69393 14.1234 2.37868C13.8082 2.06343 13.4032 1.85345 12.9639 1.77757C12.5246 1.70168 12.0726 1.7636 11.67 1.95484C11.5657 2.00459 11.4522 2.03193 11.3368 2.03509C11.2213 2.03825 11.1065 2.01716 10.9997 1.97318C10.8929 1.9292 10.7965 1.86332 10.7167 1.77978C10.637 1.69623 10.5756 1.59689 10.5366 1.48817C10.3868 1.06889 10.1109 0.706194 9.74694 0.449752C9.38294 0.193311 8.94856 0.0556641 8.5033 0.0556641C8.05804 0.0556641 7.62367 0.193311 7.25967 0.449752C6.89567 0.706194 6.61984 1.06889 6.46997 1.48817C6.43107 1.59696 6.36977 1.69637 6.29003 1.77997C6.21029 1.86357 6.11389 1.9295 6.00706 1.97348C5.90023 2.01747 5.78535 2.03854 5.66987 2.03533C5.55438 2.03212 5.44085 2.0047 5.33663 1.95484C4.93375 1.76209 4.48101 1.699 4.04078 1.77427C3.60055 1.84955 3.19449 2.05947 2.87854 2.37513C2.56259 2.69079 2.35228 3.09666 2.2766 3.53682C2.20092 3.97698 2.26359 4.42978 2.45597 4.83284C2.50593 4.93704 2.53344 5.05058 2.5367 5.1661C2.53997 5.28162 2.51892 5.39653 2.47492 5.50339C2.43092 5.61025 2.36495 5.70666 2.28129 5.78639C2.19763 5.86611 2.09815 5.92737 1.9893 5.96617C1.57032 6.11635 1.20796 6.39228 0.951779 6.75625C0.695598 7.12021 0.558105 7.55442 0.558105 7.99951C0.558105 8.44459 0.695598 8.8788 0.951779 9.24276C1.20796 9.60673 1.57032 9.88266 1.9893 10.0328C2.09838 10.0714 2.19814 10.1324 2.2821 10.212C2.36606 10.2916 2.43235 10.388 2.47667 10.4948C2.52099 10.6017 2.54235 10.7167 2.53935 10.8324C2.53636 10.948 2.50909 11.0617 2.4593 11.1662C2.26786 11.5686 2.20563 12.0203 2.28116 12.4595C2.35668 12.8986 2.56626 13.3036 2.88112 13.6189C3.19599 13.9342 3.60072 14.1444 4.03976 14.2205C4.47881 14.2967 4.93066 14.2351 5.3333 14.0442C5.43752 13.9943 5.55105 13.9669 5.66653 13.9637C5.78202 13.9605 5.8969 13.9815 6.00372 14.0255C6.11055 14.0695 6.20696 14.1354 6.2867 14.219C6.36644 14.3026 6.42774 14.4021 6.46663 14.5108C6.61651 14.9301 6.89233 15.2928 7.25633 15.5493C7.62033 15.8057 8.05471 15.9433 8.49997 15.9433C8.94523 15.9433 9.3796 15.8057 9.7436 15.5493C10.1076 15.2928 10.3834 14.9301 10.5333 14.5108C10.5722 14.4021 10.6335 14.3026 10.7132 14.219C10.793 14.1354 10.8894 14.0695 10.9962 14.0255C11.103 13.9815 11.2179 13.9605 11.3334 13.9637C11.4489 13.9669 11.5624 13.9943 11.6666 14.0442C12.0693 14.2355 12.5212 14.2975 12.9605 14.2217C13.3998 14.146 13.8049 13.9361 14.1201 13.6209C14.4354 13.3057 14.6454 12.9007 14.7212 12.4614C14.7971 12.0222 14.7352 11.5702 14.544 11.1675C14.4942 11.0633 14.4669 10.9498 14.4637 10.8343C14.4606 10.7188 14.4816 10.604 14.5256 10.4972C14.5696 10.3904 14.6355 10.294 14.719 10.2143C14.8026 10.1345 14.9019 10.0732 15.0106 10.0342C15.4299 9.8843 15.7926 9.60847 16.0491 9.24448C16.3055 8.88048 16.4431 8.4461 16.4431 8.00084C16.4431 7.55558 16.3055 7.1212 16.0491 6.7572C15.7926 6.3932 15.4299 6.11738 15.0106 5.96751L15.0133 5.96551Z" data-figma-gradient-fill="{&#34;type&#34;:&#34;GRADIENT_ANGULAR&#34;,&#34;stops&#34;:[{&#34;color&#34;:{&#34;r&#34;:0.80325442552566528,&#34;g&#34;:0.71153843402862549,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:0.36538460850715637},{&#34;color&#34;:{&#34;r&#34;:1.0,&#34;g&#34;:1.0,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:0.87980771064758301},{&#34;color&#34;:{&#34;r&#34;:1.0,&#34;g&#34;:1.0,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:1.0}],&#34;stopsVar&#34;:[{&#34;color&#34;:{&#34;r&#34;:0.80325442552566528,&#34;g&#34;:0.71153843402862549,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:0.36538460850715637},{&#34;color&#34;:{&#34;r&#34;:1.0,&#34;g&#34;:1.0,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:0.87980771064758301},{&#34;color&#34;:{&#34;r&#34;:1.0,&#34;g&#34;:1.0,&#34;b&#34;:1.0,&#34;a&#34;:1.0},&#34;position&#34;:1.0}],&#34;transform&#34;:{&#34;m00&#34;:9.7267800300174061e-16,&#34;m01&#34;:-15.885036468505859,&#34;m02&#34;:16.443141937255859,&#34;m10&#34;:15.887682914733887,&#34;m11&#34;:9.7283999805290299e-16,&#34;m12&#34;:0.05566406250},&#34;opacity&#34;:1.0,&#34;blendMode&#34;:&#34;NORMAL&#34;,&#34;visible&#34;:true}" />
                                <defs>
                                    <clipPath id="paint0_angular_2017_1428_clip_path">
                                    <path d="M15.0133 5.96551C14.9045 5.92661 14.8051 5.86531 14.7215 5.78557C14.6379 5.70583 14.572 5.60942 14.528 5.5026C14.484 5.39577 14.4629 5.28089 14.4661 5.1654C14.4694 5.04992 14.4968 4.93639 14.5466 4.83217C14.738 4.42954 14.8 3.97757 14.7242 3.53828C14.6484 3.09899 14.4385 2.69393 14.1234 2.37868C13.8082 2.06343 13.4032 1.85345 12.9639 1.77757C12.5246 1.70168 12.0726 1.7636 11.67 1.95484C11.5657 2.00459 11.4522 2.03193 11.3368 2.03509C11.2213 2.03825 11.1065 2.01716 10.9997 1.97318C10.8929 1.9292 10.7965 1.86332 10.7167 1.77978C10.637 1.69623 10.5756 1.59689 10.5366 1.48817C10.3868 1.06889 10.1109 0.706194 9.74694 0.449752C9.38294 0.193311 8.94856 0.0556641 8.5033 0.0556641C8.05804 0.0556641 7.62367 0.193311 7.25967 0.449752C6.89567 0.706194 6.61984 1.06889 6.46997 1.48817C6.43107 1.59696 6.36977 1.69637 6.29003 1.77997C6.21029 1.86357 6.11389 1.9295 6.00706 1.97348C5.90023 2.01747 5.78535 2.03854 5.66987 2.03533C5.55438 2.03212 5.44085 2.0047 5.33663 1.95484C4.93375 1.76209 4.48101 1.699 4.04078 1.77427C3.60055 1.84955 3.19449 2.05947 2.87854 2.37513C2.56259 2.69079 2.35228 3.09666 2.2766 3.53682C2.20092 3.97698 2.26359 4.42978 2.45597 4.83284C2.50593 4.93704 2.53344 5.05058 2.5367 5.1661C2.53997 5.28162 2.51892 5.39653 2.47492 5.50339C2.43092 5.61025 2.36495 5.70666 2.28129 5.78639C2.19763 5.86611 2.09815 5.92737 1.9893 5.96617C1.57032 6.11635 1.20796 6.39228 0.951779 6.75625C0.695598 7.12021 0.558105 7.55442 0.558105 7.99951C0.558105 8.44459 0.695598 8.8788 0.951779 9.24276C1.20796 9.60673 1.57032 9.88266 1.9893 10.0328C2.09838 10.0714 2.19814 10.1324 2.2821 10.212C2.36606 10.2916 2.43235 10.388 2.47667 10.4948C2.52099 10.6017 2.54235 10.7167 2.53935 10.8324C2.53636 10.948 2.50909 11.0617 2.4593 11.1662C2.26786 11.5686 2.20563 12.0203 2.28116 12.4595C2.35668 12.8986 2.56626 13.3036 2.88112 13.6189C3.19599 13.9342 3.60072 14.1444 4.03976 14.2205C4.47881 14.2967 4.93066 14.2351 5.3333 14.0442C5.43752 13.9943 5.55105 13.9669 5.66653 13.9637C5.78202 13.9605 5.8969 13.9815 6.00372 14.0255C6.11055 14.0695 6.20696 14.1354 6.2867 14.219C6.36644 14.3026 6.42774 14.4021 6.46663 14.5108C6.61651 14.9301 6.89233 15.2928 7.25633 15.5493C7.62033 15.8057 8.05471 15.9433 8.49997 15.9433C8.94523 15.9433 9.3796 15.8057 9.7436 15.5493C10.1076 15.2928 10.3834 14.9301 10.5333 14.5108C10.5722 14.4021 10.6335 14.3026 10.7132 14.219C10.793 14.1354 10.8894 14.0695 10.9962 14.0255C11.103 13.9815 11.2179 13.9605 11.3334 13.9637C11.4489 13.9669 11.5624 13.9943 11.6666 14.0442C12.0693 14.2355 12.5212 14.2975 12.9605 14.2217C13.3998 14.146 13.8049 13.9361 14.1201 13.6209C14.4354 13.3057 14.6454 12.9007 14.7212 12.4614C14.7971 12.0222 14.7352 11.5702 14.544 11.1675C14.4942 11.0633 14.4669 10.9498 14.4637 10.8343C14.4606 10.7188 14.4816 10.604 14.5256 10.4972C14.5696 10.3904 14.6355 10.294 14.719 10.2143C14.8026 10.1345 14.9019 10.0732 15.0106 10.0342C15.4299 9.8843 15.7926 9.60847 16.0491 9.24448C16.3055 8.88048 16.4431 8.4461 16.4431 8.00084C16.4431 7.55558 16.3055 7.1212 16.0491 6.7572C15.7926 6.3932 15.4299 6.11738 15.0106 5.96751L15.0133 5.96551Z" />
                                    </clipPath>
                                </defs>
                                </svg>
                            {{ userData["rank"]["name"] }}
                        </div>
                        <div class="userPlace">
                            1 место
                        </div>
                    </div>
                    
                    <hr class="row">
                    <div class="userCompetention">
                        <h3>Компетенции</h3>
                        <ul class="competentionList">
                            <li class="competentionList__item"><span>Название компетенции</span> <span class="competentionList__rang">Уровень 1</span></li>
                            <li class="competentionList__item"><span>Название компетенции</span> <span class="competentionList__rang">Уровень 1</span></li>
                            <li class="competentionList__item"><span>Название компетенции</span> <span class="competentionList__rang">Уровень 1</span></li>
                        </ul>
                    </div>
                </div>

                
            </div>

            <div class="userObjects__wrapper">
                <div class="userObjects">
                    <h3>Предметы</h3>
                    <div class="userObjects__items">
                        <div 
                        v-for="userItem in userItems"
                        class="userObjects__item">
                            <div class="bg-gray-400 rounded-lg overflow-hidden aspect-square w-full">

                            </div>
                            <span>{{ userItem.itemName }} </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
                                <button
            @click="callToast"
            class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
        >
            CallToast
        </button>
        
        <div class="flex flex-col gap-2 mt-4">
            <router-link
                v-for="link in links"
                :key="link.route"
                :to="link.route"
                class="text-blue-600 hover:underline"
            >
                {{ link.name }}
            </router-link>
        </div>
    </LkLayout>
</template>

<script setup>
import { useSiteState } from '../../store/SiteState';
import LkLayout from '../Layout/LkLayout.vue';
import { computed, onMounted, ref } from 'vue'
import { useUserStore } from '../../store/UserStore'

const userStore = useUserStore()
const siteState = useSiteState()
const isMounted = ref(false)

const links = [
    { route: '/', name: 'Home' },
    { route: '/about', name: 'About' },
    { route: '/lk', name: 'User Page' },
    { route: '/warehouse', name: 'Warehouse' },
    { route: '/login', name: 'Login Page' },
    { route: '/notifications', name: 'Notifications' },
    { route: '/actionlog', name: 'Logs' },
    { route: '/registration', name: 'Registration' },
    { route: '/divorce', name: 'Divorce Page' },
]
const userItems =[
    {
        itemName:'itemName',
        imgUrl:''
    },
        {
        itemName:'itemName222',
        imgUrl:''
    }
    
]

const callToast = () => {
    siteState.sucsesMessage = 'Изменения профиля успешно сохранены'
}

const userName = computed(() => {
    return userStore.user?.name || 'Загрузка...'
})
const userData = computed(() => {
    return userStore.user || {}
})

const imgPhoto = computed(() => {
    if (!userStore.user?.image_url) {
        return '/images/noimage.png'
    }
    return userStore.user.image_url
})

onMounted(async () => {
    isMounted.value = true
    await userStore.fetchUser()
})
</script>
<style scoped>
.header{
    background: var(--blue-700);
    border-radius: 0 0 20px 20px;
    height: 214px;
    margin-top: -10px;
    margin-bottom: 180px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 100%;
    padding-top: 76px;
}
.userInfo{
    position: absolute;
    background-color: ;
    border-radius: 12px ;
    background: var(--white-500);
    left: 20px;
    right: 20px;
    margin-top: 76px;
    padding-top: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    z-index: 2;
    justify-content:center;
    padding-left: 20px;
    padding-right: 20px;
}
.userName{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-950);
    margin-bottom: 8px;
    z-index: 3;
}
.userPhoto{
    height: 106px;
    height: 106px;
    border-radius: 100%;
    border: 4px solid var(--blue-700);
    position: absolute;
    z-index: 3;
    top: 76px;
    img{
        height: 100%;
        width: 100%;
    }
}
.userInfoItems{
    display: grid;
    grid-template-columns: repeat(3,fit-content(90px));
    gap: 4px;

}
.userPlace,
.userLevel,
.userRank{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 13px;
    color: var(--white-500);
    padding: 6px 8px;
    border-radius: 4px;
}
.userLevel{
    background: var(--blue-400);
}
.userPlace{
    background: var(--blue-300);
}
.userRank{
    display: flex;
    flex-direction: row;
    gap: 4px;
    background: var(--blue-300);
}
.row{
    height: 2px;
    background-color: var(--white-500);
    margin-top: 20px;
    width: 100%;
    padding-left: 10px;
    padding-right: 10px;
    border-radius: 2px;
}
.userCompetention{
    padding: 7px 12px 12px 12px;
    width: 100%;
}
.userCompetention h3,
.userObjects h3
{
    font-family: var(--font-family);
    font-weight: 700;
    font-size: 16px;
    color: var(--white-950);
}

.competentionList__item{
    display: flex;
    justify-content: space-between;
    font-family: var(--font-family);
    font-weight: 400;
    font-size: 13px;
    color: var(--white-950);
    padding: 4px 0;
}

.competentionList__rang{
    color: var(--blue-500);
}
.userObjects__wrapper{
    padding: 0 20px;
}
.userObjects{
    background: var(--white-500);
    border-radius: 12px;
    padding: 12px 20px ;
    display: flex;
    flex-direction: column;
    gap:12px ;
}
.userObjects__items{
    display: grid;
     grid-template-columns: 1fr 1fr;
     gap: 12px;
}
.userObjects__item{
    border: 1px solid var(--white-200);
    border-radius: 12px;
    padding: 8px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

</style>