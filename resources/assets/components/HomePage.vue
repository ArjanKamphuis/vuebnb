<template>
    <div class="home-container">
        <listing-summary-group v-for="(group, country) in listing_groups" :key="country" :listings="group" :country="country"></listing-summary-group>
    </div>
</template>

<script>
    import axios from 'axios';
    import { groupByCountry } from '../js/helpers';
    import ListingSummaryGroup from './ListingSummaryGroup';
    
    export default {
        name: 'HomePage',
        computed: {
            listing_groups() {
                return groupByCountry(this.$store.state.listing_summaries);
            }
        },
        components: {
            ListingSummaryGroup
        }
    }
</script>

<style>
    
</style>
