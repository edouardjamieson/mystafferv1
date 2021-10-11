function main() {

}

function search(q) {
   var searchq = ["publication","horaire"];
   var query = q.value;

   for(var i=0; i < searchq.length;i++){
      if(searchq[i].startsWith(query))
         alert(searchq[i]);
   }


}

function openSearch(){
   $(".search-layout").fadeIn(1);
}

function exitSearch() {
   $(".search-layout").fadeOut(1);
}
