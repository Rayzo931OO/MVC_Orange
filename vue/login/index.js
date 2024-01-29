const main = document.main
const inscription = document.querySelector('.inscription')
const connection = document.querySelector('.connection')
const inscription_summary = document.querySelector('.inscription_summary')
const connection_summary = document.querySelector('.connection_summary')

function setOpen(elem) {
   elem.open = true;
}
function setClose(elem) {
   elem.open = false;
}

inscription_summary.addEventListener('click', (e) => {
   // if e doesn't have the propriety open then open setOpen connection
   console.log(inscription.open);
   if (inscription.open) {
      setOpen(connection)
   } else {
      setClose(connection)
   }

})


connection_summary.addEventListener('click', () => {
   if (connection.open) {
      setOpen(inscription)
   }else {
      setClose(inscription)
   }
})