<script type="text/x-template" id="apartment">
    <div class="apartment">
        <h3>
            @{{apartmentTitle}}
        </h3>
    </div>
</script>

<script type="text/javascript">
    Vue.component('apartment',{
        template:"#apartment",
        data: function(){
            return {
                apartmentId: this.id,
                apartmentTitle: this.title
            }
        },
        props:{
            id: Number,
            title: String
        }
    });
</script>