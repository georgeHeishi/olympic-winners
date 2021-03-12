document.addEventListener("DOMContentLoaded", () => {
    const body = document.querySelector("#winners-body");
    let orders = [];
    document.querySelectorAll(".winners-head").forEach(item => {
        orders[item.id] = '';
        item.addEventListener("click", (event) => {
            Object.keys(orders).forEach(element => {
                if(event.target.id === element){
                    orders[event.target.id] = (orders[event.target.id] === 'ASC') ? 'DESC' : 'ASC';
                }else{
                    orders[element] = 'DESC';
                }
            });

            let url = 'https://wt98.fei.stuba.sk/olympic-winners/api/orderApi.php/?collum='
                + event.target.id
                + '&order='
                + orders[event.target.id];

            fetch(url)
                .then((response) => response.json())
                .then((data) => {
                    body.innerHTML = "";
                    JSON.parse(data.results).forEach(item => {
                        let innerHTML =
                            "<tr>" +
                                "<td><a href='/olympic-winners/detail.php/?id=" +item.id+ "'>" +
                                    item.name +
                                "</a></td>" +
                                "<td><a href='/olympic-winners/detail.php/?id=" +item.id+ "'>" +
                                    item.surname +
                                "</a></td>" +
                                "<td>" +
                                    item.year +
                                "</td>" +
                                "<td>" +
                                    item.city +
                                "</td>" +
                                "<td>" +
                                    item.type +
                                "</td>" +
                                "<td>" +
                                    item.discipline +
                                "</td>" +
                            "</tr>";
                        body.innerHTML += innerHTML;
                    });
                });
        });
    });
});