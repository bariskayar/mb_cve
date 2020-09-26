function doCallBack(aCommand, aResult){
	switch (aCommand){
		case "INFO":
			var obj = JSON.parse(aResult.replace(/'/g,""));
			console.log('FL:'+obj.doorlockstatusfrontleft.value+obj.doorstatusfrontleft.value);
			$('#FL').attr("alt", obj.doorlockstatusfrontleft.value+","+obj.doorstatusfrontleft.value);
			switch (obj.doorlockstatusfrontleft.value+obj.doorstatusfrontleft.value)
			{
				case "UNLOCKEDCLOSED":
				$('#FL').attr("src","slice_1_0_UC.png");
				
				break;				
				case "UNLOCKEDOPEN":
				$('#FL').attr("src","slice_1_0_UO.png");
				break;				
				case "LOCKEDCLOSED":
				$('#FL').attr("src","slice_1_0_LC.png");
				break;				
				case "LOCKEDOPEN":
				$('#FL').attr("src","slice_1_0_LO.png");
				break;				
			}
			console.log('FR:'+obj.doorlockstatusfrontright.value+obj.doorstatusfrontright.value);
			$('#FR').attr("alt", obj.doorlockstatusfrontright.value+","+obj.doorstatusfrontright.value);			
			switch (obj.doorlockstatusfrontright.value+obj.doorstatusfrontright.value)
			{
				case "UNLOCKEDCLOSED":
				$('#FR').attr("src","slice_1_2_UC.png");
				break;				
				case "UNLOCKEDOPEN":
				$('#FR').attr("src","slice_1_2_UO.png");
				break;				
				case "LOCKEDCLOSED":
				$('#FR').attr("src","slice_1_2_LC.png");
				break;				
				case "LOCKEDOPEN":
				$('#FR').attr("src","slice_1_2_LO.png");
				break;				
			}
			console.log('RL:'+obj.doorlockstatusrearleft.value+obj.doorstatusrearleft.value);
			$('#RL').attr("alt", obj.doorlockstatusrearleft.value+","+obj.doorstatusrearleft.value);	
			switch (obj.doorlockstatusrearleft.value+obj.doorstatusrearleft.value)
			{
				case "UNLOCKEDCLOSED":
				$('#RL').attr("src","slice_2_0_UC.png");
				break;				
				case "UNLOCKEDOPEN":
				$('#RL').attr("src","slice_2_0_UO.png");
				break;				
				case "LOCKEDCLOSED":
				$('#RL').attr("src","slice_2_0_LC.png");
				break;				
				case "LOCKEDOPEN":
				$('#RL').attr("src","slice_2_0_LO.png");
				break;				
			}
			console.log('RR:'+obj.doorlockstatusrearright.value+obj.doorstatusrearright.value);
			$('#RR').attr("alt", obj.doorlockstatusrearright.value+","+obj.doorstatusrearright.value);	
			switch (obj.doorlockstatusrearright.value+obj.doorstatusrearright.value)
			{
				case "UNLOCKEDCLOSED":
				$('#RR').attr("src","slice_2_2_UC.png");
				break;				
				case "UNLOCKEDOPEN":
				$('#RR').attr("src","slice_2_2_UO.png");
				break;				
				case "LOCKEDCLOSED":
				$('#RR').attr("src","slice_2_2_LC.png");
				break;				
				case "LOCKEDOPEN":
				$('#RR').attr("src","slice_2_2_LO.png");
				break;				
			}
		break;
	}
}

function doCommand(aCommand) {
	var xReq = $.ajax({
		method: "GET",
		url: "http://localhost/mb/action.php?"+aCommand,
		xhrFields: { withCredentials: true },
		crossDomain: true,
		headers: {},
		contentType: "application/json",
		dataType: "json",
		data:{}
	  });

	  xReq.always(function(aMsg){
		  if (aMsg.status==200) {
			  console.log(aMsg.responseText);
			  doCallBack(aCommand,aMsg.responseText);
			} else {
			  console.log(aMsg.statusText);
			}
	  });
}

var gecenSure=0;

// ---------------  HEARBEAT  ------------------------------
var start = new Date;
HeartbeatTimer = setInterval(function() {
    gecenSure++;
    if ((gecenSure % 4)==0){
      doCommand("INFO");
    }
}, 1000);
// ---------------  HEARBEAT  ------------------------------
