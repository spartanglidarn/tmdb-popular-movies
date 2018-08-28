import React, { Component } from 'react';
import './App.css';

class App extends Component {
  handleClick = () => {
    fetch("http://localhost:8080/get-top-rated-movies")
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            items: result.items
          });
        },
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }

  render() {
    return (
      <div className="App">
        <div className="Get-movies">
          <button onClick={this.handleClick}>
            Hämta filmer
          </button>
        </div>
      </div>
    );
  }
}

export default App;
