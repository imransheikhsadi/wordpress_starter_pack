import React from 'react'

export default function Content({ posts }) {
    if (!posts.flag) {
        return <h3>Not Match Found</h3>
    } else {
        return (
            <div>
                <div className="row">
                    <div className="one-third">
                        <h2>General Information</h2>
                        {
                            posts.generalInfo.map((post) => {
                                return <div key={post.id}>
                                    <a href={post.permalink}><h3>{post.title}</h3></a>
                                </div>
                            })
                        }
                    </div>
                    <div className="one-third">
                        <h2 >Programs</h2>
                        {
                            posts.programs.map((post) => {
                                return <div key={post.id}>
                                    <a href={post.permalink}><h3>{post.title}</h3></a>
                                </div>
                            })
                        }
                        <h2>Professors</h2>
                        <ul class="professor-cards">
                            {
                                posts.professors.map((post) => {
                                    return <li key={post.id} className="professor-card__list-item">
                                        <a href={post.permalink} className="professor-card">
                                            <img src={post.imageUrl} alt="" className="professor-card__image" />
                                            <span className="peofessor-card__name">{post.title}</span>
                                        </a>
                                    </li>
                                })
                            }
                        </ul>
                    </div>
                    <div className="one-third">
                        <h2>Campuses</h2>
                        {
                            posts.campuses.map((post) => {
                                return <div key={post.id}>
                                    <a href={post.permalink}><h3>{post.title}</h3></a>
                                </div>
                            })
                        }
                        <h2>Events</h2>
                        {
                            posts.events.map((post) => {
                                return <div key={post.id}>
                                    <div class="event-summary">
                                        <a class="event-summary__date t-center" href={post.permalink}>
                                            <span class="event-summary__month">{post.timeM}</span>
                                            <span class="event-summary__day">{post.timed}</span>
                                        </a>
                                        <div class="event-summary__content">
                                            <h5 class="event-summary__title headline headline--tiny"><a href={post.permalink}>{post.title}</a></h5>
                                            <p>{post.excerpt}<a href={post.permalink} class="nu gray">Learn more</a></p>
                                        </div>
                                    </div>
                                </div>
                            })
                        }
                    </div>
                </div>
            </div>
        )
    }
}