<script type="text/x-template" id="apartments-template">
    <div class="apartments">
        <apartment v-for="apartments">
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