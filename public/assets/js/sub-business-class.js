        $(document).on('click', '.new-sub-business-class', function(e){
            e.preventDefault();
            $('.saveSubBusinessClassBtn').show();
            $('.saveSubBusinessClassChangesBtn').hide();
            $('.sub-business-class-title').text('Add New Sub-business Class');
            $('#sub_business_class_name').val('');
        });
        $(document).on('click', '.saveSubBusinessClassBtn', function(e){
            e.preventDefault();
            if($('#sub_business_class_name').val() == '' || $('#class').val() == ''){
                Toastify({
                  text: "All fields are required.",
                  duration: 3000, 
                  close: true,
                  gravity: "top",
                  position: 'right',
                  backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                  stopOnFocus: true,
                  onClick: function(){}
                }).showToast();

            }else{
                $('.saveSubBusinessClassBtn').text('Processing...');
                axios.post('/policy/sub-business-class/create',{
                  sub_business_class_name:$('#sub_business_class_name').val(),
                  class:$('#class').val()
                })
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
                    $('.saveSubBusinessClassBtn').text('Save');
                    $('#new-sub-business-class-modal').hide();
                    $('.modal-backdrop fade show').hide();
                    $('#sub_business_class_name').val('');
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
                    $('.saveSubBusinessClassBtn').text('Save');
                });
            }
        });

        $(document).on('click', '.edit-sub-business-class', function(e){
            e.preventDefault();
            $('.saveSubBusinessClassBtn').hide();
            $('.saveSubBusinessClassChangesBtn').show();
            $('.sub-business-class-title').text('Edit Sub-business Class Name');
            var sub_business_class = $(this).data('sub-business-class');
            var id = $(this).data('sub-business-class-id');
            $('#sub_business_class_name').val(sub_business_class);
            $('#subBusinessId').val(id);
        });

        $(document).on('click', '.saveSubBusinessClassChangesBtn', function(e){
            e.preventDefault();
            if($('#sub_business_class_name').val() == ''){
                Toastify({
                  text: "All fields is required.",
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
                axios.post('/policy/sub-business-class/edit',{
                  class:$('#class').val(),
                  sub_business_class_name:$('#sub_business_class_name').val(),
                  id:$('#subBusinessId').val(),
                })
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
                    $('.saveSubBusinessClassBtn').text('Save');
                    $('#new-sub-business-class-modal').hide();
                    $('.modal-backdrop fade show').css('display', 'none');
                    $('#sub_business_class_name').val('');
                    $('#subBusinessTable').load(location.href + " #subBusinessTable");
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
                    $('.saveSubBusinessClassBtn').text('Save');
                });
            }
        });