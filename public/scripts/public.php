<script>

    function postRequestDirectly(route,json,returnStatus=true)
    {

        route= window.location.origin+'/'+route;
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('value')}
        });

        postObject=$.ajax({
            type:'POST',
            url:route,
            data:json
        });

        if(returnStatus) return postObject;
    }
    

    /**
     * Send get request without delay
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function sendGetRequest(route,request,functionName,id,returnObject)
    {
        route="<?php echo url('/'); ?>"+'/'+route+'/'+id;
        var url = "<?php echo asset('templates/icons/main/loading/loading2.gif')?>";
        var loaderImage='<img src="'+url+'">';
        $('.loader').html(loaderImage).show();
        var getObject=$.ajax
        ({
            url: route,
            type:'GET',
            data:request
        });
        if(returnObject)  return getObject;
        processGetRequest(getObject,functionName);
    }


    /**
     * Process get request data without delay
     * @written by Hadi Mansoori Rad
     * @email company.gtna@gmail.com
     */
    function processGetRequest(getRequestObject,functionName)
    {
        var realData;
        getRequestObject.success(function(realData)
        {
            $('.loader').hide(1);
        });

        getRequestObject.error(function (xhr, status)
        {
            alert('Unknown error ' + status);
        });

        if (functionName)
        {
            window[functionName](getRequestObject);
        }
        return getRequestObject;
    }

    /**
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function _alert(type,messages,arrayFlag)
    {
        message='';
        if(typeof (messages)=='object') arrayFlag=true; else arrayFlag=false;
        if(arrayFlag)
        {
            for(var index in messages)
                message+=" <div class='alert alert-"+type+"'> <span class='fa fa-warning'></span>  "+ messages[index]+"</div>";
            return (message);
        }else
        {
            message="<div class='alert alert-"+type+"'><span class='fa fa-check'></span>   "+messages+"</div>";
            return  (message);
        }
    }
    

    function showModalMessage(type,message)
    {
        message="<div class='alert alert-"+type+"'><span class='fa fa-check'></span>   "+message+"</div>";
        showModal('#main-modal');
        importHtml('.messages',message);
    }

    /**
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function doThis(functionName,lists,delay)
    {
        !delay ? 0 : delay;
        lists=lists.split(',');
        if(functionName=='hide')
        {
            if(lists.length>0)
                lists.forEach(function (item)
                {
                    $("label[for='"+item+"']").fadeOut(delay);
                    $(item).fadeOut(delay);
                });
        }else if(functionName=='remove')
        {
            lists.forEach(function (item)
            {
                $(item).remove();
            });
        }else{
            if(lists.length>0)
                lists.forEach(function (item)
                {
                    $("label[for='"+item+"']").fadeIn(delay);
                    $(item).fadeIn(delay);
                });
        }
    }

    /**
     *
     * sending request without crash
     *
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     * @param formId
     * @param alertType
     * @param functionName
     */
    function sendRequest(formId,alertType,functionName,value)
    {
        !alertType ? 'success' : alertType;
        $("#"+formId).on('submit',function(e)
        {
            e.preventDefault();
            if(!sessionStorage.getItem('key')=='NaN')
            {
                var  runCount=0;
                sessionStorage.setItem('key', runCount+1);
            }
            var runCount=sessionStorage.getItem('key');
            sessionStorage.setItem('key',  runCount+1);
            runCount=sessionStorage.getItem('key');
            if(runCount==1)
            {
                var postObject = sendPostRequest(formId, e);
                if (functionName)
                    window[functionName](postObject,value);
                else
                {
                    postObject.done(function(result){
                         result=JSON.parse(result);
                        showError(result, alertType);
                    });
                }
            }
        });
        sessionStorage.clear();
    }


    /**
     *
     * Sending post request without crash
     *
     * @written by Hadi Mansoori Rad
     * @email company.gtna@gmail.com
     */
    function sendPostRequest(formIdOrRoute,event,directlyPostStatus,jsonData)
    {
        //disable the default form submission
        event.preventDefault();
        $.ajaxSetup({
            headers:{'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('value')}
        });

        var ajaxData={
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data){$('.loader').hide();},
            error: function (xhr, status) {alert('Unknown error ' + status);}
        };
        if(directlyPostStatus)
        {
            var route = '<?php echo url('/') . '/';?>' + formIdOrRoute;
            Object.assign(ajaxData, {url: route},{data:jsonData});
            delete ajaxData['contentType'];
            delete ajaxData['processData'];
        }else
        {
            var formData = new FormData($('#'+formIdOrRoute)[0]);
            var route=$('#'+formIdOrRoute).attr('action');
            Object.assign(ajaxData, {url: route},{data:formData});
        }


        $('.loader').html("<img width='30px' src='<?php echo asset('images/loading.gif')?>'>").show();


        var postObject=$.ajax(ajaxData);
        if(directlyPostStatus)
        {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
        }

        return (postObject);
    }


    function showError(jsonData)
    {
        showModal();
        var errors='';
        $.each(jsonData.data, function( index, value ) {
            errors+=" <div class='alert alert-danger'>"+ value+  "</div>";
        });

        importHtml('.messages',errors);

    }

    /**
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function showModal(classOrId)
    {
        if(!classOrId) classOrId='#main-modal';
        $(classOrId).modal('show');
    }

    /**
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function hideModal(classOrId)
    {
        $(classOrId).modal('hide');
    }

    /**
     * @written by Hadi Mansoori Rad
     * @email eh.mansoori@gmail.com
     */
    function importHtml(classOrId,contents)
    {
        $(classOrId).html(contents);
    }
    
    
    function redirect(url)
    {
        window.location.assign(url);
    }


</script>