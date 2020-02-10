<script type="text/x-template" id="apartments-template">
    <div class="container">
        <div class="searchbar">
            <input v-model="search" type="text" placeholder="Ricerca apartamenti" class="text-center w-100">
        </div>
        <div class="apartments row">
            <apartment  v-for="apartment in filteredApartments" v-bind:key="apartment.id" v-if="apartment.sponsored == 1"
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
            :sponsored='apartment.sponsored'
            >
            </apartment>
        </div>
    </div>
    
</script>

<script type="text/javascript">
    Vue.component('apartments',{
        template:"#apartments-template",
        data: function(){
            return {
                search: ''
            };
        },
        props:{
            apartments: Array
        },
        computed:{
            filteredApartments(){
                return this.apartments.filter(
                    apartment =>
                        apartment.address.toLowerCase().includes(this.search.toLowerCase())
                        // apartment.address.toLowerCase().includes(this.search.toLowerCase())
                    );
                }
        }
    });
</script>