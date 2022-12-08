import JustValidate from 'just-validate';

const validation = new JustValidate("#create_form", {
    errorFieldCssClass: "is-invalid",
    errorFieldStyle: {
        border: "1px solid red",
    },
    errorLabelCssClass: "is-label-invalid",
    errorLabelStyle: {
        color: "#CF4A2E",
        textDecoration: "underlined",
    },
});
validation
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("/api/users/validate", {
                    method: 'POST',
                    body: JSON.stringify({'email': value}),
                })
                    .then(function (response) {
                        return response.json();
                    })

                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "email already exists"
        }

    ])
    .addField('#name', [
        {
            rule: 'required',
        },
        {
            rule: 'customRegexp',
            value: /^[\w]{2,}\ [\w]{2,}$/,
            errorMessage: "Your first and last name"
        }

    ])
    .addField('#status', [
        {
            rule: 'required',
        }

    ])
    .addField('#gender', [
        {
            rule: 'required',
        }
    ])

    .onSuccess((event) => {
        document.getElementById("create_form").submit();

    });