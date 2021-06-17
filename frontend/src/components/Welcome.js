import React from "react";
import styles from './Welcome.module.css'

class Welcome extends React.Component {
  constructor(props) {
    super(props);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.welcome = React.createRef();
  }
  handleSubmit(event) {
    event.preventDefault();
    fetch('/api/upload', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: this.welcome.current.files['0']
    }).then((response) => {})
      .then((success => console.log(success)))
      .catch((error) => {})
  }
  render() {
    return (
      <div className={styles.welcome}>
        <h1>FS-Server</h1>
        <p>Мы скоро откроемся</p>
        <form onSubmit={this.handleSubmit}>
          <label>
            Upload file:
            <input type="file" ref={this.welcome} />
          </label>
          <br />
          <button type="submit">Submit</button>
        </form>
      </div>
    )
  }
  }

  /*
const handleSubmit = (event) => {
  event.preventDefault()

  fetch('/api/upload', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
  }).then(r => {})
}*/
/*

function Welcome() {

}
*/

export default Welcome