

require('./bootstrap');

window.Vue = require('vue');
var _ = require('lodash');
let toastify = require('toastify-js');


const app = new Vue({
    el: '#motor',
    data:{
    	policy:{
    		policy_number:'',
    		insurance_policy_number:'',
    		start_date:'',
    		end_date:'',
    		business_class:1,
    		sub_business_class:1,
    		//
    		insured_name:'',
    		email:'',
    		mobile_number:'',
    		address:'',
            birth_date:'',
            policy_type:2, //motor
    		agent:1,
            agents:{},
            states:{},
            clients:{},
            makes:{},
            covers:{},
            currencies:{},
    		//
    		sum_insured:'',
    		currency:'',
    		exchange_rate:365,
    		premium_rate:'',
    		gross_premium:0,
            //vehicle
            vehicle:[{
                cover_type:1,
                chassis_no:'',
                engine_no:'',
                certificate_no:'',
                state_issued:1,
                make:1,
                vehicle_value:''
            }],
            documentation_for:2, //new client; existing = 1
    	},
    	errs:{}, //errors
        business_classes:{},
        sub_business_classes:{},

    	sum_insured:1000,
    	exchange_rate:365,
    	currency:'Naira',
    	premium_rate:5,
    	hide_exchange_box:false,
    	inDollar: false,
        change_error:false,
        change_success:false,
        success_note:false,
        error_note:false,
        processing:false,
    },
    watch:{
    	exchange_rate:function(val){
    		this.policy.exchange_rate = val;
    	},
    	currency:function(val){
    		this.policy.currency = val;
    		if(val == "Naira"){
    			this.hide_exchange_box = false;
    		}else{
    			this.hide_exchange_box = true;
    			inDollar = true;
    		}
    	},
    	sum_insured:function(val){
    		this.policy.sum_insured = val;
    	},
    	premium_rate:function(val){
    		this.policy.premium_rate = val;
    	},
    },
    methods:{
    	initializeInstance(){
    		axios.post('/policy/initialize-instance')
    		.then(response=>{
                this.policy.policy_number = response.data.policyNumber;
                this.business_classes = response.data.classes;
                this.policy.states = response.data.states;
                this.policy.makes = response.data.makes;
                this.policy.agents = response.data.agents;
                this.policy.clients = response.data.clients;
               this.policy.covers = response.data.covers;
               this.policy.makes = response.data.makes;
               this.policy.states = response.data.states;
               this.policy.currencies = response.data.currencies;
    		});
    	},

    	postMotorPolicy(){
            this.processing = true;
    		axios.post('/policy/add-new-policy',this.$data.policy)
    		.then(response=>{
    			this.change_success = true;
                this.success_note = true;
                this.processing = false;
                toastify.Toastify({
                    text: "Policy documented!",
                    duration: 3000,
                    //destination: "https://github.com/apvarun/toastify-js",
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function(){} // Callback after click
                }).showToast();
    		})
    		.catch(error=>{
    			this.errs = error.response.data.errors;
                this.change_error = true;
                this.error_note = true;
                this.processing = false;
                toastify.Toastify({
                    text: "This is a toast",
                    duration: 3000,
                    //destination: "https://github.com/apvarun/toastify-js",
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #0000ff)",
                    },
                    onClick: function(){} // Callback after click
                }).showToast();
    		});
    	},

        //add another vehicle
        addAnotherVehicle:function(){
            this.policy.vehicle.push({
                cover_type:'',
                chassis_no:'',
                engine_no:'',
                reg_no:'',
                state_issued:'',
                make:'',
                vehicle_value:'',
            });
        },

        //remove vehicle from list
        removeFromList:function(index){
            this.policy.vehicle.splice(index, 1);
        },



        //get corresponding sub business class
        getSubBusinessClass:function(){
            axios.post('/policy/get-sub-business-classes',{id:this.policy.business_class})
            .then(response=>{
                this.sub_business_classes = response.data.sub_business_classes;
            });
        },
        calculateGrossPremium(){
            let sumInsured = this.policy.sum_insured;
            let premiumRate = this.policy.premium_rate;
            sumInsured === 0 ? 100 : sumInsured;
            premiumRate === 0 ? 1 : premiumRate;
            const grossPremium = sumInsured*(premiumRate/100);
            this.policy.gross_premium = grossPremium.toFixed(2);
            //console.log("Log value: "+grossPremium);
        }

    },
    computed:{
        handleGrossPremiumChange:function(){
            //console.log('Out here');
    		/*var gp = null;
    		if(this.currency == "Naira"){
    			gp = ((this.premium_rate/100)*this.sum_insured);
    			this.policy.gross_premium = gp;
    			return gp;
    		}else{
    			gp = ((this.premium_rate/100)*(this.sum_insured));
    			this.policy.gross_premium = gp;
    			return gp;
    		}*/
            this.calculateGrossPremium();
    	},
        handleSumInsuredChange(){
          //this.handleGrossPremiumChange();
            this.calculateGrossPremium();
        },

    	inNaira:function(){
    		return naira = this.sum_insured * this.exchange_rate;
    	}
    },

    created(){
    	//auto generate policy number
    	this.policy.sum_insured = this.sum_insured;
    	this.policy.premium_rate = this.premium_rate;
        this.policy.currency = this.currency;
        this.initializeInstance();
    },

});
