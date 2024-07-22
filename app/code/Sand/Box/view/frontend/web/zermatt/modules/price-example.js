/**
 * @author Hervé Guétin <www.linkedin.com/in/herveguetin>
 */
export default {
    price: null,
    myFormattedPrice() {
        //Zermatt.Event.on(['SandBox:loaded', 'SandBox:init'], (result) => console.log(result))
        Zermatt.Event.on(['SandBox:loaded', 'SandBox:init'], (events) => {
            events.map(event => console.log(event))
        })
        //Zermatt.Event.on(['SandBox:loaded'], (result) => console.log('AGIN'))
        return Zermatt.Money.formatPrice(this.price, null, 'EUR')
    }
}
