
    
      $(document).ready(function() {

        $('#log').on('click', logout);   
        
      });

       function wms_access(){
        var user_id = localStorage.getItem('user_id');
        var comp_id = localStorage.getItem('company_id');
        
        if(!(user_id && comp_id)){
          
          $('body').addClass('background');
          document.title = 'Employee.ng';
          window.location.href = site_url;
        }else{
          $('body').show();
        } 
       }
        
       function user_module_access(){

        var user_id = localStorage.getItem('user_id');
        var company_id = localStorage.getItem('company_id');
        var module_id = 13;

        $.ajax({
         
            type: "POST",
            dataType: "json",
            url: api_path+"user/check_if_user_has_access_to_a_module ",
            data: {"company_id": company_id, "user_id" : user_id, "module_id" : module_id},
            timeout: 60000, // sets timeout to one minute
            
            error: function(response){
                alert('Connection error');
            },

            success: function(response) {
                

                if(response.status == '200'){
                
                  // alert('success');

                }else{
                    
                    alert('No module access,');
                    window.location.href = site_url+"/user";        
                }

            }
        }); 
      }

      function company_module_access(){
        var company_id = localStorage.getItem('company_id');
        var module_id = 19;

        $.ajax({ 
            type: "POST",
            dataType: "json",
            url: api_path+"user/check_if_company_has_access_to_a_module ",
            data: {"company_id": company_id, "module_id" : module_id},
            timeout: 60000, // sets timeout to one minute
            
            error: function(response){
                alert('Connection error');
            },

            success: function(response) {
                

                if(response.status == '200'){
                
                  // alert('success');

                }else{
                    
                    alert('No module access.');
                    window.location.href = site_url+"/user";        
                }

            }
        }); 
      } 

      function logout(){
        alert("chief")
        localStorage.clear();
        window.location.href = "https://www.paperlack.com.ng/world";
        // window.location.href;
        // window.location.replace("https://www.paperlack.com.ng");
      }