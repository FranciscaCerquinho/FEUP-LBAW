

function SplitDate(dateTime){
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
    var second = parseInt(splitSecond[0]);
    var hour = hour + parseInt(second_aux[1]);
  
    if(currentDate.getFullYear()==year){
      if(currentDate.getMonth()+1==month){
        if(currentDate.getDay()==day){
          if(currentDate.getHours()==hour){
            if(currentDate.getMinutes()==minute){
              timeLeft= second-currentDate.getSeconds();
              stringToReturn= timeLeft.toString()+" seconds";
              document.write(stringToReturn);
            }
            else{
              timeLeft= minute-currentDate.getMinutes();
              stringToReturn= timeLeft.toString()+" minutes left";
              document.write(stringToReturn);
            }
          }
          else{
            timeLeft= hour-currentDate.getHours();
            stringToReturn= timeLeft.toString()+" hours left";
            document.write(stringToReturn);
          }
        }
        else{
          timeLeft= day-currentDate.getDay();
          stringToReturn= timeLeft.toString()+" days left";
          document.write(stringToReturn);
        }
      }
      else{
        timeLeft= month-currentDate.getMonth()+1;
        stringToReturn= timeLeft.toString()+" months left";
        document.write(stringToReturn);
      }
    }
    else{
      timeLeft= year-currentDate.getFullYear();
      stringToReturn= timeLeft.toString()+" years left";
      document.write(stringToReturn);
    }
  }