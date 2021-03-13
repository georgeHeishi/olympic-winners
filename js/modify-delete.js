document.addEventListener("DOMContentLoaded", () => {
    const modify = document.querySelectorAll(".modify");
    const remove = document.querySelectorAll(".remove");
    remove.forEach(item => {
        item.addEventListener("click", (event) => {
            const id = event.target.id.replace("remove", "");
            const url = 'api/deleteApi.php';
            const request = new Request(url, {
                method: 'POST',
                body: JSON.stringify({
                    id:id
                }),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8'
                }
            });

            fetch(request)
                .then((response) => response.json())
                .then((data) => {
                    if(data.result){
                        location.reload();
                    }
                });
        })
    });

    modify.forEach(item => {
        item.addEventListener("click", (event) => {
            let id = event.target.id.replace("modify", "");
        })
    })
})