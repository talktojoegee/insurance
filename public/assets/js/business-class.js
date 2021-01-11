        $(document).on('click', '.new-business-class', function(e){
            e.preventDefault();
            $('.saveBusinessClassBtn').show();
            $('.saveBusinessClassChangesBtn').hide();
            $('.business-class-title').text('Add New Business Class');
            $('#business_class_name').val('');
        });
        $(document).on('click', '.saveBusinessClassBtn', function(e){
            e.preventDefault();
            if($('#business_class_name').val() == ''){
                Toastify({
                  text: "Business class name is required.",
                  duration: 3000, 
                  close: true,
                  gravity: "top",
                  position: 'right',
                  backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                  stopOnFocus: true,
                  onClick: function(){}
                }).showToast();

            }else{
                $('.saveBusinessClassBtn').text('Processing...');
                axios.post('/policy/business-class/create',{business_class_name:$('#business_class_name').val()})
                .then(response=>{
                    Toastify({
                      text: response.data.message,
                      duration: 3000, 
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveBusinessClassBtn').text('Save');
                    $('#new-business-class-modal').hide();
                    $('.modal-backdrop fade show').hide();
                    $('#business_class_name').val('');
                    //$('#businessClassTable').load(location.href + " #businessClassTable");
                })
                .catch(err=>{
                    Toastify({
                      text: err.response.data.msg,
                      duration: 3000, 
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveBusinessClassBtn').text('Save');
                });
            }
        });

        $(document).on('click', '.edit-business-class', function(e){
            e.preventDefault();
            $('.saveBusinessClassBtn').hide();
            $('.saveBusinessClassChangesBtn').show();
            $('.business-class-title').text('Edit Business Class Name');
            var business_class = $(this).data('business-class');
            var id = $(this).data('business-class-id');
            $('#business_class_name').val(business_class);
            $('#businessId').val(id);
        });

        $(document).on('click', '.saveBusinessClassChangesBtn', function(e){
            e.preventDefault();
            if($('#business_class_name').val() == ''){
                Toastify({
                  text: "Business class name is required.",
                  duration: 3000, 
                  close: true,
                  gravity: "top",
                  position: 'right',
                  backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                  stopOnFocus: true,
                  onClick: function(){}
                }).showToast();

            }else{
                $('.saveBusinessClassBtn').text('Processing...');
                axios.post('/policy/business-class/edit',{business_class_name:$('#business_class_name').val(),id:$('#businessId').val()})
                .then(response=>{
                    Toastify({
                      text: response.data.message,
                      duration: 3000, 
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveBusinessClassBtn').text('Save');
                    $('#new-business-class-modal').hide();
                    $('.modal-backdrop fade show').css('display', 'none');
                    $('#business_class_name').val('');
                    $('#businessTable').load(location.href + " #businessTable");
                })
                .catch(err=>{
                    Toastify({
                      text: err.response.data.msg,
                      duration: 3000, 
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
                    $('.saveBusinessClassBtn').text('Save');
                });
            }
        });