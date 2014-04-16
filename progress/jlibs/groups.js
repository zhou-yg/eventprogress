var mygroupsid = "mygroups_window";
var allgroupsid = "groupslist_window";

var lookupAllObj = Im.getObj("lookupAllGroups");
var lookupMyObj = Im.getObj("lookupMyGroups");
var createObj = Im.getObj("createButton");

var glideToAll1 = new glidelr("glideToAll1");
var glideToAll2 = new glidelr("glideToAll2");

var glideToMy1 = new glidelr("glideToMy1");
var glideToMy2 = new glidelr("glideToMy2");

/*-----------------------------------------------------------*/
var createG = function(){
	var bgObj;
	var frameObj;

	return{
		init : function(){
			bgObj = Im.getObj("groupContainer");
			frameObj = Im.getObj("groupFrame");
		},
		createCancel : function(){
			bgObj.style.display = "none";
			frameObj.style.display = "none";
		},
		createInput : function(){
			bgObj.style.display = "block";
			frameObj.style.display = "block";
		},
		createComplete : function(){
			bgObj.style.display = "none";
			frameObj.style.display = "none";
			
			var groupNameObj = Im.getObj("groupName");
			var groupDescriptionObj = Im.getObj("groupDescription");
			
			var groupMsgObj = new Object();
			groupMsgObj["type"] = "create";
			groupMsgObj["name"] = groupNameObj.value;
			groupMsgObj["description"] = groupDescriptionObj.value;
			
			var jsonData = JSON.stringify(groupMsgObj);
			sendData = jsonData;
			Im.sendRequest("http://localhost/EventProgress/progress/phps/groups_handler.php",jsonData,"POST",this.createCompleteResponse);
		},
		createCompleteResponse : function(){
			
		}
	}
}();
var setAll = function(){
	return{
		init:function(){
			Im.sendRequest("http://localhost/EventProgress/progress/phps/groups_handler.php","allinit","POST",this.setAllInitResponse);
		},
		setAllInitResponse : function(){
			returnState = xmlRequest.readyState;
			returnData = xmlRequest.responseText;
			if (returnState == 4) {
				console.log(returnData);		
			}else{
		
			}
		}
	}	
}();
var setMy = function(){
	
	var ul_id = "mygroups_window_list_ul";
	
	var C = function(){
		return{
			createlistGroup : function(group_name){
				var htmlText = "<li class='list_group'>";
				htmlText += "<div class='list_group_label'>";
				htmlText += "<a href=''>"+group_name+"</a>";
				htmlText += "</div>";
				htmlText += "</li>";
				return htmlText;
			},
			createButton : function(){
				var htmlText = "<li class='list_group'>";
				htmlText += "<div class=list_group_create'>创建新的组</div>";
				htmlText += "</li>";
				return htmlText;
			}
		}
	}();
	
	return{
		init:function(){			
			Im.sendRequest("http://localhost/EventProgress/progress/phps/groups_handler.php","myinit","POST",this.setMyInitResponse);
		},
		setMyInitResponse : function(){
			returnState = xmlRequest.readyState;
			returnData = xmlRequest.responseText;
			if (returnState == 4) {
				if(returnData == "null"){
					
				}else{
					
				}
			}else{
		
			}
		}
	}
}();
/*--------------------------------------------*/
createG.init();
/*--------------------------------------------*/
function lookupAll(){
	console.log("setAll");

	glideToAll1.go(mygroupsid,1,800);
	glideToAll2.go(allgroupsid,1,800);
	setAll.init();
}
function lookupMy(){
	console.log("setMy");
	glideToMy1.go(mygroupsid,1,-800);
	glideToMy2.go(allgroupsid,1,-800);
	
	setMy.init();
}
function createCancel(){
	console.log("createCancel()");
	createG.createCancel();
}
function createInput(){
	console.log("createInput()");
	createG.createInput();
}
function createComplete(){
	console.log("createComplete()");
	createG.createComplete();
}