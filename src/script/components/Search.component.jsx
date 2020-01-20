import Input from './Input.component.jsx';
import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import Content from './Content.component.jsx'
import Loader from './Loader.component.jsx';

export class Search extends Component {
  constructor(props) {
    super(props)

    this.state = {
      loading: false,
      searchField: '',
      searchResult: [],
      searchButtonClicked: false
    }
    this.timer = null
  }

  componentDidMount(){
    document.querySelector('#search').addEventListener('click',this.searchHandler);
    window.addEventListener('keypress',(event)=>{
      if (event.charCode === 115 && !this.state.searchButtonClicked) {
        this.searchHandler()
      }
    });
    window.addEventListener('keydown',(event)=>{
      if (event.key === "Escape"  && this.state.searchButtonClicked) {
        this.searchHandler()
      }
    });

  }

  searchHandler = (event) =>{
    this.setState((prevState,props)=>(
      {searchButtonClicked: !prevState.searchButtonClicked}),()=>{
      if (this.state.searchButtonClicked) {
        document.querySelector('body').classList.add('body-no-scroll')
      } else {
        document.querySelector('body').classList.remove('body-no-scroll')
      }
    })
  }

  searchFieldHandler = (event)=>{
    if (!this.state.loading) {
      this.loader(true)
    }
    this.setState({searchField: event.target.value},()=>{
        if (this.timer) {
          clearTimeout(this.timer); //cancel the previous timer.
            this.timer = null;
          }
        this.timer = setTimeout(this.fetchData, 800);
        if (this.state.searchField === '') {
          this.loader(false)
        }
    });
  }

  fetchData = ()=>{
      if (this.state.searchField !== '') {
        this.loader(true)
        axios.get(`http://localhost:6780/index.php/wp-json/university/v1/search?term=${this.state.searchField}`)
        .then((response)=>this.setState({searchResult: response.data},()=>{
          this.loader(false)
        }))
        .catch((err)=>{
          console.log(err)
          this.loader(false)
        })
      }
  }

  loader = (value)=>{
    if (value) {
      this.setState({loading: value})
    }else{
      this.setState({loading: !this.state.loading})
    }
  }


  // shouldComponentUpdate(nextProps, nextState) {
  //
  //   if (nextState.searchResult.length === this.state.searchResult.length && this.state.searchField !== '') {
  //     return false;
  //   }
  //   return true
  // }

  render() {
    return (
      <div className={`search-overlay ${this.state.searchButtonClicked && 'search-overlay--active'}`}>
        <div className="search-overlay__top">
          <div className="container">
            <i className="fa fa-search search-overlay__icon" aria-hidden="true"></i>
              <Input handler={this.searchFieldHandler}/>
            <i className="fa fa-window-close search-overlay__close" aria-hidden="true" onClick={this.searchHandler}></i>
          </div>
        </div>
        <div className="container">
           {this.state.loading ? <Loader/> : this.state.searchField !== '' && <Content posts={this.state.searchResult}/>}
        </div>
      </div>
    )
  }
}

export default Search
