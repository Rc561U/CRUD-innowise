import "./script"

(async () => {
    if (document.getElementById('create_form')) {
        await import('./create_validation');
    } else if(document.getElementById('update_form')) {
        await import('./update_validations');
    }
})();