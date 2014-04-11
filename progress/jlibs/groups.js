var lookupAllObj = Im.getObj("lookupAllGroups");
var lookupMyObj = Im.getObj("lookupMyGroups");

var mygroupsid = "mygroups_window";
var allgroupsid = "groupslist_window";

var glideToAll1 = new glidelr("glideToAll1");
var glideToAll2 = new glidelr("glideToAll2");

var glideToMy1 = new glidelr("glideToMy1");
var glideToMy2 = new glidelr("glideToMy2");

lookupAllObj.onclick = function(){
	glideToAll1.go(mygroupsid,1,800);
	glideToAll2.go(allgroupsid,1,800);

	setAll.init();
}
lookupMyObj.onclick = function(){
	glideToMy1.go(mygroupsid,1,-800);
	glideToMy2.go(allgroupsid,1,-800);
	
	setMy.init();
}
var setAll = function(){
	return{
		init:function(){
			
		}
	}	
}();
var setMy = function(){
	return{
		init:function(){
			
		}
	}
}
