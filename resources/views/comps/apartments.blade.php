<script type="text/x-template" id="apartments-template">
    <div class="apartments">
        <apartment  v-for="apartment in apartments" v-bind:key="apartment.id"
        :id='apartment.id'
        :title='apartment.title'
        :address='apartment.address'
        :description='apartment.description'
        :img='apartment.img'
        :roomNum='apartment.roomNum'
        :bedNum='apartment.bedNum'
        :mQ='apartment.mQ'
        :wcNum='apartment.wcNum'
        :view='apartment.view'
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