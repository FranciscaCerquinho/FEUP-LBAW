function SplitDate(dateTime,value){
  var currentDate= new Date();
  var timeLeft;
  var stringToReturn;
  //var h = document.querySelector("#newAuctions #auctions-list .card-body h1");

  var splitDate = dateTime.split(" ");
  var date = splitDate[0];
  var hours = splitDate[1];

  var aux_date= date.split("-");
  var year= parseInt(aux_date[0]);
  var month= parseInt(aux_date[1]);
  var day= parseInt(aux_date[2]);

  var time = hours.split(":");
  var hour = parseInt(time[0]);
  var minute = parseInt(time[1]);
  var second_aux = time[2];
  var splitSecond = second_aux.split("+");
  var second = parseInt(splitSecond[0]) 
  var hour = hour + parseInt(splitSecond[1]);

  if(currentDate.getFullYear()==year){
    if(currentDate.getMonth()+1==month){
      if(currentDate.getDate()==day){
        if(currentDate.getHours()==hour){
          if(currentDate.getMinutes()==minute){
            if(value==1)
              timeLeft= second-currentDate.getSeconds();
            else
              timeLeft= currentDate.getSeconds()-second;
            if(parseInt(timeLeft)!=1){
            stringToReturn= timeLeft.toString()+" seconds";
            }
            else stringToReturn= timeLeft.toString()+" second";

            document.write(stringToReturn);
          }
          else{
            if(value==1)
              timeLeft= minute-currentDate.getMinutes();
            else
              timeLeft= currentDate.getMinutes()-minute;
            if(parseInt(timeLeft)!=1){
            stringToReturn= timeLeft.toString()+" minutes";
            }
            else stringToReturn= timeLeft.toString()+" minute";
            document.write(stringToReturn);
          }
        }
        else{
          if(value==1)
            timeLeft= hour-currentDate.getHours();
          else
            timeLeft= currentDate.getHours()-hour;
          if(parseInt(timeLeft)!=1){
          stringToReturn= timeLeft.toString()+" hours";
          }
          else stringToReturn= timeLeft.toString()+" hour";
          document.write(stringToReturn);
        }
      }
      else{
        if(value==1)
          timeLeft= day-currentDate.getDate();
        else
        timeLeft= currentDate.getDate()-day;
        if(parseInt(timeLeft)!=1){
        stringToReturn= timeLeft.toString()+" days";
        }
        else stringToReturn= timeLeft.toString()+" day";
        document.write(stringToReturn);
      }
    }
    else{
      if(value==1)
        timeLeft= month-currentDate.getMonth();
      else
        timeLeft= currentDate.getMonth()-month;
      if(parseInt(timeLeft)!=1){
      stringToReturn= timeLeft.toString()+" months";
      }
      else stringToReturn= timeLeft.toString()+" month";
      document.write(stringToReturn);
    }
  }
  else{
    if(value==1)
      timeLeft= year-currentDate.getFullYear();
    else
      timeLeft= currentDate.getFullYear()-year;
    if(parseInt(timeLeft)!=1){
    stringToReturn= timeLeft.toString()+" years";
    }
    else stringToReturn= timeLeft.toString()+" year";
    document.write(stringToReturn);
  }
}



function SplitDateReturn(dateTime){
  var currentDate= new Date();
  var timeLeft;
  var stringToReturn;
  //var h = document.querySelector("#newAuctions #auctions-list .card-body h1");

  var splitDate = dateTime.split(" ");
  var date = splitDate[0];
  var hours = splitDate[1];

  var aux_date= date.split("-");
  var year= parseInt(aux_date[0]);
  var month= parseInt(aux_date[1]);
  var day= parseInt(aux_date[2]);

  var time = hours.split(":");
  var hour = parseInt(time[0])+1;
  var minute = parseInt(time[1]);
  var second = parseInt(time[2]);



  if(currentDate.getFullYear()==year){
    if(currentDate.getMonth()+1==month){

      if(currentDate.getDate()==day){
        if(currentDate.getHours()==hour){
          if(currentDate.getMinutes()==minute){
            timeLeft= currentDate.getSeconds()-second;
            if(parseInt(timeLeft)!=1){
            stringToReturn= timeLeft.toString()+" seconds";
            }
            else stringToReturn= timeLeft.toString()+" second";

            return stringToReturn;
          }
          else{
            timeLeft= currentDate.getMinutes()-minute;
            if(parseInt(timeLeft)!=1){
            stringToReturn= timeLeft.toString()+" minutes";
            }
            else stringToReturn= timeLeft.toString()+" minute";
            return stringToReturn;
          }
        }
        else{
          timeLeft= currentDate.getHours()-hour;
          if(parseInt(timeLeft)!=1){
          stringToReturn= timeLeft.toString()+" hours";
          }
          else stringToReturn= timeLeft.toString()+" hour";
          return stringToReturn;
        }
      }
      else{
        timeLeft= currentDate.getDate()-day;
        if(parseInt(timeLeft)!=1){
        stringToReturn= timeLeft.toString()+" days";
        }
        else stringToReturn= timeLeft.toString()+" day";
        return stringToReturn;
      }
    }
    else{
      timeLeft= currentDate.getMonth()-month;
      if(parseInt(timeLeft)!=1){
      stringToReturn= timeLeft.toString()+" months";
      }
      else stringToReturn= timeLeft.toString()+" month";
      return stringToReturn;
    }
  }
  else{
    timeLeft= currentDate.getFullYear()-year;
    if(parseInt(timeLeft)!=1){
    stringToReturn= timeLeft.toString()+" years";
    }
    else stringToReturn= timeLeft.toString()+" year";
    return stringToReturn;
  }
}
