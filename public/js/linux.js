     $(document).ready(function(){
      var commandSuggestion = "";
      var parameterSuggestion = "";

      //Fetch all commands from the controller in JSON format
      var getRandomColor = function(){
        var colors = ["red","orange","green"];
        var rand = Math.floor((Math.random() * 5));
        return colors[rand];
      };

      $("#linuxCommandsTags").tagit({
        allowDuplicates: true
      });
      $("#linuxCommandsTagsRun").tagit({
        allowDuplicates: true,
        readOnly: true
      });
      $(".linuxCommTags").tagit({
        allowDuplicates: true
      });
      $("#parameterS").select2({
        placeholder: "Select a Parameter"
      });

      $.get('/linuxcommands/index.php/linux/listcommands', function(data){
        commands = data;
        sourceArray = [];
        $("#parameterS").html("<option></option>");
        for (var i = 0; i < data.length; i++) {
          sourceArray.push(data[i].name + "->" + data[i].details); 
          $("#parameterS").append("<option>" + data[i].name + "->" + data[i].details + "</option>");
        }
        //Providing data source(command list) to the Suggest Box
        $("input[name='command_txt']").typeahead({ source:sourceArray });
      },'json');

      //Code Tag and Keyword Highlighting (highlight.js)
      hljs.initHighlightingOnLoad();

      $(".run_modified_script").click(function(){
        //calistirilmak istenen tagit componentinin id'si tutulur
        var tagId = $(this).attr("data-id");

        commandDetails = $("#" + tagId).tagit("assignedTags");
        if (commandDetails != "") {
          $.ajax({
            type: "POST",
            url: '/linuxcommands/index.php/linux/run_modified_script',
            //Adding a parameter that contains json string of command
            data: {modified_commands : JSON.stringify(commandDetails)},
            dataType: 'json',
            success: function(data){
              $("#terminal").html("");
              //Refresh the Terminal screen with the new command result
              $("#terminal").append("linux$ " + data.commands.join(' ') + "\n");
              for(var i = 0; i < data.output.length; i++){
                $("#terminal").append(data.output[i] + "\n");
              }
              //socialize.php deki runCommandModal idli modali gostermek icin calistirilan kod
              $("#runCommandModal").modal('show');
            }
          });
        }
      });

      $("#new_user").click(function(){
        $('#signUpModal').modal('show');
        }
      );

      $('#signUpModal').on('hidden.bs.modal', function (e) {
        $('#newName').val("");
        $('#newSurname').val("");
        $('#newUsername').val("");
        $('#newPassword').val("");
      });

      $("#show_script_save").click(function(){
        $('#save_script_modal').modal('show');
        }
      );

      $("#save_script").click(function(){
        var scriptElements = new Array();
        var scriptName = document.getElementById("script_name").value;
        commandDetails = $("#linuxCommandsTags").tagit("assignedTags");
        for(var i = 0; i < commandDetails.length; i++){
          scriptElements.push(commandDetails[i].split('->')[0]);
        }
        if (scriptName != "") {
          $.ajax({
            type: "POST",
            url: '/linuxcommands/index.php/script/add_command',
            //Adding a parameter that contains json string of command
            data: {comms : JSON.stringify(scriptElements), name: scriptName},
            dataType: 'json',
            success: function(data){
              }
            });
          }
        $('#save_script_modal').modal('hide');
        }
      );

      $('#save_script_modal').on('hidden.bs.modal', function (e) {
        document.getElementById("script_name").value = "";
      });

      $(".add_script").click(function(){
        var scriptIdToBeAdded = $(this).attr("data-id");
        $.ajax({
          type: "POST",
          url: '/linuxcommands/index.php/script/add_user_script',
          data: {scriptToBeAdded: scriptIdToBeAdded},
          dataType: 'text',
          success: function(data){
            alert("Script is added");
            }
          });
        }
      );

      $("#follow_user").click(function(){
        var userToBeFollowed = document.getElementById("users_combo").value;
        var followerUser = document.getElementById("current_user").value;
        $.ajax({
          type: "POST",
          beforeSend: function(){
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
              } 
            });
          },
          url: '/linuxcommands/index.php/social/add_sharer',
          data: {followerUserId: followerUser, sharerUserId : userToBeFollowed},
          dataType: 'json',
          success: function(data){
              $.unblockUI();
              window.location = "http://localhost/linuxcommands/index.php/social/load_shares/";
          }
        }); 
      });

      $(".addCommandBtn").click(function(){
        var tags = $("#linuxCommandsTags").tagit("assignedTags");
        if(tags.length >= 1){
          $("#linuxCommandsTags").tagit("createTag", "|", "darkgray");
          $.get('/linuxcommands/index.php/linux/listcommands', function(data){
            commands = data;
            sourceArray = [];

            $("#parameterS").html("<option></option>");
            for (var i = 0; i < data.length; i++) {
              sourceArray.push(data[i].name + "->" + data[i].details); 
              $("#parameterS").append("<option>" + data[i].name + "->" + data[i].details + "</option>");
            }
          },'json');
        }
      });

      $(".addCustomBtn").click(function(){
        var tags = $("#linuxCommandsTags").tagit("assignedTags");
        if(tags.length >= 1){
          var customParameter = prompt("Please add custom parameter","");
          if (customParameter != "") {
            //Add custom parameter to the tag
            $("#linuxCommandsTags").tagit("createTag", customParameter + "->Custom Parameter", "lightgray");
          }
        }
      });

      $(".uploadFileForm").ajaxForm({
        dataType: "json",
        beforeSubmit: function(){
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
              } 
            });
        },
        success: function(responseData){
          $.unblockUI();
          if(responseData.result){
            $("#linuxCommandsTags").tagit("createTag", responseData.file_path + "->Custom Parameter", "gray");
          }
          else{
            alert(responseData.error);
          }
          $('#uploadFileModal').modal('hide');
        }
      });

      //profile picture i eklemek icin onay butonuna basildiginda cagrilan fonksiyon(form submit edildiginde)
      $(".uploadPicForm").ajaxForm({
        dataType: "json",
        beforeSubmit: function(){
          //upload sirasinda user interface'i blokla
            $.blockUI({ css: { 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
              } 
            });
        },
        success: function(responseData){
          //user interfacee upload sirasinda konulan please wait blogunu kaldir
          $.unblockUI();
          if(responseData.result){
            //alert("Profile picture is changed successfully");
          }
          else{
            //jpg png veya gif disinda bir dosya upload edilmeye calisildiginda hata goster
            alert(responseData.error);
          }
          //islem sonunda modali hide et
          $('#uploadPicModal').modal('hide');
          //islem sonunda yeni eklenen profile picturei gostermek icin sayfayi yenile
          window.location = "http://localhost/linuxcommands/index.php/profile/load_profile/";
        }
      });

      //After changing the command text box, new tag is added on the Tag division
      $("#parameterS").change(function(){
        //Add new tag to the tag list with provided command text
        var tags = $("#linuxCommandsTags").tagit("assignedTags");
        if(tags.length == 0){
          $("#linuxCommandsTags").tagit("createTag", $(this).val(), "darkgray");
          $(".addCommandBtn").removeClass('hide');
          $(".addCustomBtn").removeClass('hide');
          $(".uploadFileBtn").removeClass('hide');
        }
        else{
          $("#linuxCommandsTags").tagit("createTag", $(this).val(), "gray");
        }
        //If command or parameter has custom parameter open popup and add value to the tag
        var tags = $("#linuxCommandsTags").tagit("assignedTags");
        if(tags.length == 1){
          //Current is command
            var found = false;
            var foundedCommand = null;
            //Find command from my command array
            for(var i = 0; i < commands.length; i++){
              if(commands[i].name == tags[0].split('->')[0]){
                found = true;
                foundedCommand = commands[i];
                break;
              }
            }
            if(found){
              //Check command has custom parameter or not
              if(foundedCommand.information != null){
                $.noty.closeAll()
                noty({text: foundedCommand.information, layout: 'topRight', type: 'information'});
              }
              if(foundedCommand.custom == "1"){
                //Open prompt
                var customParameter = prompt("Please add custom parameter","");
                if (customParameter != "") {
                  //Add custom parameter to the tag
                  $("#linuxCommandsTags").tagit("createTag", customParameter + "->Custom Parameter", "lightgray");
                }
              }
            }
        }
        else if(tags.length > 1){
          //Current is parameter
            var found = false;
            var foundedCommand = null;
            //Find command
            for(var i = 0; i < commands.length; i++){
              if(commands[i].name == tags[0].split('->')[0]){
                found = true;
                foundedCommand = commands[i];
                break;
              }
            }
            if(found){
              if(foundedCommand.information != null){
                $.noty.closeAll()
                noty({text: foundedCommand.information, layout: 'topRight', type: 'information'});
              }
              found = false;
              foundedParameters = null;
              parameters = JSON.parse(foundedCommand.parameters);
              //Find parameter with the provided parameter from command
              sourceArray = [];
              for (var i = 0; i < parameters.length; i++) {
                if(parameters[i].param == tags[tags.length - 1].split('->')[0]){
                  found = true;
                  foundedParameters = parameters[i];
                  break;
                }
              }
              if(found){
                //Check parameter has custom parameter or not
                if(foundedParameters.custom == true){
                  var customParameter = prompt("Please add custom parameter","");
                  $("#linuxCommandsTags").tagit("createTag", customParameter + "->Custom Parameter", "lightgray");
                }
              }
            }
        }
        //Clears the command text box
        $(this).prop("selectedIndex",0);
      });
      $("#linuxCommandsTags").tagit({
        //After new tag is added following event will be triggered
        afterTagAdded: function(event, ui){
          //Get current tags
          var tags = $(this).tagit("assignedTags");
          var currentParams = [];
          for(var i = 0; i < tags.length; i++){
            currentParams.push(tags[i].split('->')[0]);
          }
          //Convert current commands to the JSON string
          var tagsJsonString = JSON.stringify(currentParams);
          //Call Ajax to Refresh Result
          $.ajax({
            type: "POST",
            url: '/linuxcommands/index.php/linux/executecommand',
            //Adding a parameter that contains json string of command
            data: {commands: tagsJsonString},
            dataType: 'json',
            success: function(data){
              //Make the Terminal Screen empty
              $("#terminal").html("");
              //Refresh the Terminal screen with the new command result
              $("#terminal").append("linux$ " + currentParams.join(' ') + "\n");
              for(var i = 0; i < data.length; i++){
                $("#terminal").append(data[i] + "\n");
              }
            }
          });

          if(tags.length >= 1){
            //After choosing commands, we need to show parameters of command in the suggest box
            //Get Parameters of Command
            var found = false;
            var foundedCommand = null;
            for(var i = 0; i < commands.length; i++){
              if(commands[i].name == tags[0].split('->')[0]){
                found = true;
                foundedCommand = commands[i];
                break;
              }
            }
            if(found){
              //Update Typehead (Suggest Textbox)
              parameters = JSON.parse(foundedCommand.parameters);
              sourceArray = [];
              $("#parameterS").html("<option></option>");
              for (var i = 0; i < parameters.length; i++) {
                $("#parameterS").append("<option>" + parameters[i].param + "->" + parameters[i].details + "</option>");
                sourceArray.push(parameters[i].param + "->" + parameters[i].details); 
              }
              $("input[name='command_txt']").typeahead('destroy')
              $("input[name='command_txt']").typeahead({ source:sourceArray });
            }
          }
        },
        //After a tag is removed following event will be triggered
        afterTagRemoved: function(event, ui){
          var tags = $(this).tagit("assignedTags");
          if(tags.length >= 1){
            //Get current tags
            var tags = $(this).tagit("assignedTags");
            var currentParams = [];
            for(var i = 0; i < tags.length; i++){
              currentParams.push(tags[i].split('->')[0]);
            }
            //Convert current commands to the JSON string
            var tagsJsonString = JSON.stringify(currentParams);
            //Call Ajax to Refresh Result
            $.ajax({
              type: "POST",
              url: '/linuxcommands/index.php/linux/executecommand',
              data: {commands: tagsJsonString},
              dataType: 'json',
              success: function(data){
                $("#terminal").html("");
                $("#terminal").append("linux$ " + currentParams.join(' ') + "\n");
                for(var i = 0; i < data.length; i++){
                  $("#terminal").append(data[i] + "\n");
                }
              }
            });
          }
          else{
            $(".addCommandBtn").addClass('hide');
            $(".addCustomBtn").addClass('hide');
            $(".uploadFileBtn").addClass('hide');
            //Update Typehead (Suggest Textbox)
            //Clear the Terminal Screen
            $("#terminal").html("");
            $("#terminal").append("linux$ \n");
            $("#parameterS").html("<option></option>");
            sourceArray = [];
            for (var i = 0; i < commands.length; i++) {
              $("#parameterS").append("<option>" + commands[i].name + "->" + commands[i].details + "</option>");
              sourceArray.push(commands[i].name + "->" + commands[i].details); 
            }
            $("input[name='command_txt']").typeahead('destroy')
            $("input[name='command_txt']").typeahead({ source:sourceArray });
          }
        }
      });
    });