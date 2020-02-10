<script type="text/x-template" id="apartment">
    <div class="apartment">
        <h3>
            @{{apartmentTitle}}
        </h3>
        <ul>
            <li> <strong> Address :</strong>     @{{apartmentAddress}}      </li>
            <li> <strong> Description :</strong>     @{{apartmentDescription}}      </li>
            <li> <strong> Img :</strong>    @{{apartmentImg}}       </li>
            <li> <strong> RoomNum :</strong>     @{{apartmentRoomNum}}      </li>
            <li> <strong> BedNum :</strong>     @{{apartmentBedNum}}      </li>
            <li> <strong> MQ :</strong>     @{{apartmentMQ}}      </li>
            <li> <strong> WcNum :</strong>     @{{apartmentWcNum}}      </li>
            <li> <strong> View :</strong>     @{{apartmentView}}      </li>
        </ul>

    </div>
</script>

<script type="text/javascript">
    Vue.component('apartment',{
        template:"#apartment",
        data: function(){
            return {
                apartmentId: this.id,
                apartmentTitle: this.title,
                apartmentAddress: this.address,
                apartmentDescription: this.description,
                apartmentImg: this.img,
                apartmentRoomNum: this.roomNum,
                apartmentBedNum: this.bedNum,
                apartmentMQ: this.mQ,
                apartmentWcNum: this.wcNum,
                apartmentView: this.view
            }
        },
        props:{
            id: Number,
            title: String,
            address: String,
            description: String,
            img: String,
            roomNum: Number,
            bedNum: Number,
            mQ: Number,
            wcNum: Number,
            view: Number
        }
    });
</script>