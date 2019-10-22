function addItem(value, id){
    if (value == "") {
        return;
    }

    var ul = document.getElementById("userQuestionsList");
    var li = document.createElement("li");
    li.setAttribute('value', value);

    var removeButton = document.createElement("i");
    removeButton.setAttribute("class", "icon icon-trash");
    removeButton.onclick = function () {
        this.parentElement.parentElement.removeChild(this.parentElement);
    };

    li.appendChild(removeButton);
    li.appendChild(document.createTextNode(value));

    var tempElement = document.createElement("input");
    tempElement.setAttribute("type", "hidden");
    tempElement.setAttribute("name", "jform[questions][" + id + "]");
    tempElement.setAttribute("value", value);
    li.appendChild(tempElement);

    ul.appendChild(li);
}