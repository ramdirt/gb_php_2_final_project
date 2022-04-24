let countItemBasket = document.querySelector(".countItemBasket");

const buttonsAddBasket = document.querySelectorAll(".btn-add-basket");
if (buttonsAddBasket) {
    buttonsAddBasket.forEach((button) => {
        button.addEventListener("click", (event) => {
            const id = event.currentTarget.dataset.id;
            addBasket(id);
        });
    });
    async function addBasket(id) {
        console.log(id);
        let formData = new FormData();
        formData.append("id", id);

        const res = await fetch("/basket/add", {
            method: "POST",
            body: formData,
        });

        const data = await res.json();

        if (data.status === true) {
            countItemBasket.innerText = data.countItemBasket;
        } else {
            alert("Ошибка отправки комментария");
        }
    }
}

const buttonsDeleteBasket = document.querySelectorAll(".btn-delete-basket");
if (buttonsDeleteBasket) {
    buttonsDeleteBasket.forEach((button) => {
        button.addEventListener("click", (event) => {
            const id = event.currentTarget.dataset.id;
            deleteBasket(id);
        });
    });
    async function deleteBasket(id) {
        let formData = new FormData();
        formData.append("id", id);
        console.log(id);

        const res = await fetch("/basket/delete", {
            method: "POST",
            body: formData,
        });

        const data = await res.json();

        console.log(data);

        if (data.status === true) {
            div = document.querySelector(`[data-id="${id}"]`);
            if (data.action) {
                data.action == "delete"
                    ? div.remove()
                    : (div.querySelector("span").innerText -= 1);
            }
            countItemBasket.innerText = data.countItemBasket;
        } else {
            alert("Ошибка удаления");
        }
    }
}
