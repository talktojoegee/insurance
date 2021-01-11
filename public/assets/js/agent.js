        $(document).on('click', '.new-agent', function(e){
            e.preventDefault();
            $('.saveAgentBtn').show();
            $('.saveAgentChangesBtn').hide();
            $('.agent-title').text('Add New Agent');
            $('#agent_name').val('');
        });
        $(document).on('click', '.saveAgentBtn', function(e){
            e.preventDefault();
            if($('#agent_name').val() == ''){
                Toastify({
                  text: "Agent name is required.",
                  duration: 3000, 
                  close: true,
                  gravity: "top",
                  position: 'right',
                  backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                  stopOnFocus: true,
                  onClick: function(){}
                }).showToast();

            }else{
                $('.saveAgentBtn').text('Processing...');
                axios.post('/policy/agent/create',{agent_name:$('#agent_name').val()})
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
                    $('.saveAgentBtn').text('Save');
                    $('#new-agent-modal').hide();
                    $('.modal-backdrop fade show').hide();
                    $('#agent_name').val('');
                    $('#agentsTable').load(location.href + " #agentsTable");
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
                    $('.saveAgentBtn').text('Save');
                });
            }
        });

        $(document).on('click', '.edit-agent', function(e){
            e.preventDefault();
            $('.saveAgentBtn').hide();
            $('.saveAgentChangesBtn').show();
            $('.agent-title').text('Edit Agent Name');
            var agent = $(this).data('agent');
            var id = $(this).data('agent-id');
            $('#agent_name').val(agent);
            $('#agentId').val(id);
        });

        $(document).on('click', '.saveAgentChangesBtn', function(e){
            e.preventDefault();
            if($('#agent_name').val() == ''){
                Toastify({
                  text: "Agent name is required.",
                  duration: 3000, 
                  close: true,
                  gravity: "top",
                  position: 'right',
                  backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                  stopOnFocus: true,
                  onClick: function(){}
                }).showToast();

            }else{
                $('.saveAgentBtn').text('Processing...');
                axios.post('/policy/agent/edit',{agent_name:$('#agent_name').val(),id:$('#agentId').val()})
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
                    $('.saveAgentBtn').text('Save');
                    $('#new-agent-modal').hide();
                    $('.modal-backdrop fade show').css('display', 'none');
                    $('#agent_name').val('');
                    $('#agentsTable').load(location.href + " #agentsTable");
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
                    $('.saveAgentBtn').text('Save');
                });
            }
        });