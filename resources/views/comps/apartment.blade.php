<script type="text/x-template" id="apartment-template">
    <div class="apartment">
        <h3>
            @{{apartmentTitle}}
        </h3>
    </div>
</script>

<script type="text/javascript">
    Vue.component('apartment',{
        template:"#apartment-template",
        data: function(){
            return {
                apartmentTitle: this.title
            }
        },
        props:{
            id: Number,
            title: String
        }
    });
</script>