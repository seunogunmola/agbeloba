                function check_all() {

                    administrator = document.getElementById('selecctall');
                    checkboxes = document.getElementsByName('privileges[]');

                    if(administrator.checked == true){
                        
                       administrator.checked = source.checked;
                        for(var i=0,n=checkboxes.length;i<n;i++) {
                          checkboxes.checked = true;
                             
                          
                        }
                    }
                    else{

                        var count = 0;
                        for(var i=0, n=checkboxes.length;i<n;i++) {
                          if(checkboxes[i].checked === true){
                              ++count;
                          }
                        }

                        if(count == checkboxes.length){
                            administrator = document.getElementById('selecctall');
                            administrator.checked = true;
                        }else{
                            administrator = document.getElementById('selecctall');
                            administrator.checked = false;
                        }
                    }
                }