$(document).ready(() => {
    $('.bond').on('click', (event) => {
        $(event.currentTarget).next().toggle();
    })
    
}) 