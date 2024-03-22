/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    success: false,
    submitted: false,
    form: null,
    init() {
        this.form = this.$form(
            'post',
            this.$refs.form.getAttribute('action'),
            JSON.parse(this.$refs.form.getAttribute('x-data'))
        )
    },
    onSuccess(response) {
        window.location.href = response.data.redirect
    },
    submit() {
        this.submitted = true
        this.form.submit()
            .then(response => {
                this.form.reset()
                this.$refs.form.reset()
                this.success = true
                this.submitted = false
                this.onSuccess(response)
                setTimeout(() => {
                    this.success = false
                }, 4500)
            })
            .then(this.$refs.form.scrollIntoView())
            .catch(error => {
                console.log('Form has errors and was not submitted.')
            })
    }
}
