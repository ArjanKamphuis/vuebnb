<template>
    <div>
        <header-image v-if="listing.images[0]" :image-url="listing.images[0]" :id="listing.id" @header-clicked="openModal"></header-image>
        <div class="listing-container">
            <div class="heading">
                <h1>{{ listing.title }}</h1>
                <p>{{ listing.address }}</p>
            </div>
            <hr>
            <div class="about">
                <h3>About this listing</h3>
                <expandable-text>{{ listing.about }}</expandable-text>
            </div>
            <div class="lists">
                <feature-list title="Amenities" :items="listing.amenities">
                    <template slot-scope="amenity">
                        <i class="fa fa-lg" :class="amenity.icon"></i>
                        <span>{{ amenity.title }}</span>
                    </template>
                </feature-list>
                <feature-list title="Prices" :items="listing.prices">
                    <template slot-scope="price">
                        {{ price.title }}: <strong>{{ price.value }}</strong>
                    </template>
                </feature-list>
            </div>
        </div>
        <modal-window ref="imagemodal">
            <image-carousel :images="listing.images"></image-carousel>
        </modal-window>
    </div>
</template>

<script>
    import { populateAmenitiesAndPrices } from '../js/helpers';
    import ExpandableText from './ExpandableText.vue';
    import FeatureList from './FeatureList.vue';
    import HeaderImage from './HeaderImage.vue';
    import ImageCarousel from './ImageCarousel.vue';
    import ModalWindow from './ModalWindow.vue';

    export default {
        name: 'ListingPage',
        computed: {
            listing() {
                return populateAmenitiesAndPrices(this.$store.getters.getListing(this.$route.params.listing));
            }
        },
        methods: {
            openModal() {
                this.$refs.imagemodal.modalOpen = true;
            }
        },
        components: {
            ExpandableText,
            FeatureList,
            HeaderImage,
            ImageCarousel,
            ModalWindow
        }
    }
</script>

<style>
    .heading {
        margin-bottom: 2em;
    }

    .heading h1 {
        font-size: 32px;
        font-weight: 700;
    }

    .heading p {
        font-size: 15px;
        color: #767676;
    }
    
    .about {
        margin-top: 2em;
    }

    .about h3 {
        font-size: 22px;
    }
</style>
