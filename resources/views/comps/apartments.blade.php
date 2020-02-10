<script type="text/x-template" id="apartments-template">
    <div class="apartments">
        <apartment  v-for="apartment in apartments" v-bind:key="apartment.id"
        :id='apartment.id'
        :title='apartment.title'
        >
        </apartment>
    </div>
</script>

<script type="text/javascript">
    Vue.component('apartments',{
        template:"#apartments-template",
        data: function(){
            return {
            }
        },
        props:{
            apartments: Array
        }
    });
</script>