const $ = (selector) => {
    return document.querySelector(selector);
}

const addClass = (selector, className) => {
    const element = $(selector);
    if (element) {
        element.classList.add(className);
    }
};

const removeClass = (selector, className) => {
    const element = $(selector);
    if (element) {
        element.classList.remove(className);
    }
};

const hide = (selector) => {
    const element = $(selector);
    if (element) {
        element.style.display = 'none';
    }
};

const show = (selector) => {
    const element = $(selector);
    if (element) {
        element.style.display = 'block';
    }
};

document.addEventListener('DOMContentLoaded', function () {
    $("#sign-up").addEventListener('click', function () {
        removeClass("#sign-in", "active");
        hide("#sign-in-form");
        addClass("#sign-up", "active");
        show("#sign-up-form");
    });

    $("#sign-in").addEventListener('click', function () {
        addClass("#sign-in", "active");
        show("#sign-in-form");
        removeClass("#sign-up", "active");
        hide("#sign-up-form");
    });
});

const goToAfterSucessfulLogIn = (event) => {
    event.preventDefault();  
    console.log("Moving to Create.html")
    window.location.href = "Create.html";
}

const submitHousingEntry = (event) => {
    event.preventDefault();  
    console.log("Create Operation");
}

const signOut = (event) => {
    event.preventDefault();  
    console.log("Signing Out");
    window.location.href = "form.html";
}

const deleteHousingEntry = (event) => {
    event.preventDefault();  
    console.log("Deleting entry");
}

const updateHousingEntry = (event) => {
    event.preventDefault();  
    console.log("Updating entry");
}

const goToUpdate = (event) => {
    event.preventDefault();  
    console.log("Signing Out");
    window.location.href = "Update.html";
}