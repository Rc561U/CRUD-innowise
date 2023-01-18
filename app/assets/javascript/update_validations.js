import JustValidate from 'just-validate';

const validation = new JustValidate("#update_form", {
    errorFieldCssClass: "is-invalid",
    errorFieldStyle: {
        border: "1px solid red",
    },
    errorLabelCssClass: "is-label-invalid",
    errorLabelStyle: {
        color: "#e13815",
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
                    body: JSON.stringify({'email': value, "user_id": user_id.value}),
                })
                    .then(function (response) {
                        return response.json();
                    })

                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "Email already exists"
        }

    ])
    .addField('#name', [
        {
            rule: 'required',
        },
        {
            rule: 'customRegexp',
            value: /^([a-zA-Z' ]+)$/,
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
        document.getElementById("update_form").submit();

    });