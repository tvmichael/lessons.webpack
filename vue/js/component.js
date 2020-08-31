let template = {
    product: '<div class="product">' +
        '                    <div class="col-md-2 col-sm-5">' +
        '                        <div class="product-image">' +
        '                            <label v-show="imgLabel">{{label}}</label>' +
        '                            <img v-bind:src="image"' +
        '                                v-bind:alt="alt"' +
        '                                class="img-thumbnail"' +
        '                            />' +
        '                        </div>' +
        '                    </div>' +
        '                    <div class="col-md-10 col-sm-7">' +
        '                        <div class="product-info">' +
        '                            <h1>{{title}}</h1>' +
        '                            <p v-if="inStock">In stock</p>' +
        '                            <p v-else>Out of stock</p>' +
        '                            <p>{{canSale}}</p>' +
        '                            <p>User is premium: {{premium}}</p>' +
        '                            <p>Shipping: {{shipping}}</p>' +
        '                            <product-detail :details="details"></product-detail>' +
        '                            <div>' +
        '                                <p v-for="(variant, index) in variants"' +
        '                                    v-bind:data-id="variant.variantId"' +
        '                                    class="color-box">' +
        '                                    <span' +
        '                                        @mouseover="updateProduct(index)"' +
        '                                        :style="[variant.variantStyle, styleObjectSpan]">' +
        '                                    </span>' +
        '                                </p>' +
        '                            </div>' +
        '                            <button v-on:click="cart += 1"' +
        '                                :class="{ \'disabled-button\': !inStock }"' +
        '                            >Add to cart</button>' +
        '                            <button v-on:click="addToCart" :disabled="!inStock">Add to basket</button>' +
        '                            <button v-on:click="removeFromCart" :disabled="!inStock">Remove from Cart</button>' +
        '                        </div>' +
        '                    </div>' +
        '<div class="product-review">' +
            '<h3>Reviews</h3>'+
            '<ul>' +
                '<li v-for="review in reviews">Name:{{review.name}} [{{review.review}}] R:{{review.rating}} </li>'+
            '</ul>' +
        '</div>' +
        '<div class="product-review">' +
            '<product-review @review-submitted="addReview"></product-review>'+
        '</div>' +
        '                </div>',
    detail: '<ul class="detail">' +
            '<li v-for="detail in details">{{detail}}</li>' +
        '</ul>',
    review: '<form class="review-form" @submit.prevent="onSubmit">'+
        '<div v-if="errors.length" class="bg-warning">' +
            '<p v-for="error in errors">{{error}}</p>'+
        '</div>'+
        '<div class="form-group">' +
            '<label for="name">Name</label>' +
            '<input id="name" v-model="name" class="form-control">' +
        '</div>'+
        '<div class="form-group">' +
            '<label for="review">Review</label>' +
            '<input id="review" v-model="review" class="form-control">' +
        '</div>'+
        '<div>' +
            '<label for="rating">Rating</label>' +
            '<select id="rating" v-model="rating" class="form-control">' +
                '<option>1</option>' +
                '<option>2</option>' +
                '<option>3</option>' +
                '<option>4</option>' +
                '<option>5</option>' +
            '</select>'+
        '</div>'+
        '<input type="submit">' +
    '</form>',
};
Vue.component('product', {
    props:{
        premium:{
            type: Boolean,
            required: true,
        }
    },
    template: template.product,
    data(){
        return{
            brand: 'Mik test',
            product: 'Socks',
            onSale: true,
            styleObjectSpan:{
                boxShadow: '2px 3px 1px 2px grey'
            },
            //image: './assets/m-socks-1.jpg',
            selectedVariant: 0,
            alt: 'socks image 1',
            //inStock: false,
            label: 'Buy',
            imgLabel: false,
            details: ['80% cotton', '20% polyester', 'General neutral'],
            variants:[
                {
                    variantId: 11,
                    variantStyle: {backgroundColor:'green'},
                    variantImage: './assets/m-socks-1.jpg',
                    variantClass: 'active',
                    variantQuantity: 10,
                },
                {
                    variantId: 12,
                    variantStyle: {backgroundColor:'blue', border:'2px solid red'},
                    variantImage: './assets/m-socks-2.jpg',
                    variantClass: '',
                    variantQuantity: 10,
                }
            ],
            cart: 0,
            variantsClass: '',
            reviews: [],
        }
    },
    methods:{
        addToCart: function () {
            let id = this.variants[this.selectedVariant].variantId;
            this.$emit('add-to-cart', {id:id, action:'add'});
        },
        updateProduct: function(index){
            this.selectedVariant = index;
            console.log(index);
        },
        removeFromCart: function () {
            let id = this.variants[this.selectedVariant].variantId;
            this.$emit('remove-from-cart', {id:id, action:'remove'});
        },
        addReview(productReview) {
            this.reviews.push(productReview)
        }
    },
    computed:{
        title(){
            return this.brand + ' ' + this.product;
        },
        image(){
            return this.variants[this.selectedVariant].variantImage;
        },
        inStock(){
            return this.variants[this.selectedVariant].variantQuantity;
        },
        canSale(){
            return this.onSale ? (this.brand + ' ' + this.product + ' sale:' + this.onSale): '';
        },
        shipping(){
            if(this.premium){
                return 'Yes!';
            }
            else {
                return 'No.'
            }
        },
    }
});

Vue.component('product-detail', {
    props:{
        details:{
            type: Array,
            required: true
        }
    },
    template: template.detail,
});

Vue.component('product-review', {
    template: template.review,
    data(){
        return {
            name:null,
            review:null,
            rating:null,
            errors:[]
        }
    },
    methods:{
        onSubmit(){
            this.errors = [];
            if(this.name && this.rating && this.review)
            {
                let productReview = {
                    name: this.name,
                    review: this.review,
                    rating: this.rating,
                };
                this.$emit('review-submitted', productReview);

                this.name = null;
                this.review = null;
                this.rating = null;
            }
            else
            {
                if(!this.name) this.errors.push('Empty: name');
                if(!this.rating) this.errors.push('Empty: rating');
                if(!this.review) this.errors.push('Empty: review');
            }
        }
    }
});

var app = new Vue({
    el: '#vue-app',
    data: {
        premium: true,
        cart: [],
    },
    methods: {
        updateCart: function (data) {
            console.log(data);

            if(data.action == 'add')
            {
                this.cart.push(data.id);
            }
            if(data.action == 'remove')
            {
                let i = this.cart.indexOf(data.id);
                this.cart.splice(i, 1);
            }
        },
    }
});