    $(document).ready(function(){
      //Fetch all commands from the controller in JSON format
      $.get('/linuxcommands/index.php/linux/listcommands', function(data){
        commands = data;
        sourceArray = [];
        for (var i = 0; i < data.length; i++) {
          sourceArray.push(data[i].name + "->" + data[i].details); 
        }
        //Providing data source(command list) to the Suggest Box
        $("input[name='command_txt']").typeahead({ source:sourceArray });
      },'json');

      //Code Tag and Keyword Highlighting (highlight.js)
      hljs.initHighlightingOnLoad();

      //After changing the command text box, new tag is added on the Tag division
      $("input[name='command_txt']").change(function(){
        //Add new tag to the tag list with provided command text
        $("#linuxCommandsTags").tagit("createTag", $(this).val());
        //Clears the command text box
        $(this).val("");
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
              for (var i = 0; i < parameters.length; i++) {
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
            //Update Typehead (Suggest Textbox)
            //Clear the Terminal Screen
            $("#terminal").html("");
            $("#terminal").append("linux$ \n");
            sourceArray = [];
            for (var i = 0; i < commands.length; i++) {
              sourceArray.push(commands[i].name + "->" + commands[i].details); 
            }
            $("input[name='command_txt']").typeahead('destroy')
            $("input[name='command_txt']").typeahead({ source:sourceArray });
          }
        }
      });
    });